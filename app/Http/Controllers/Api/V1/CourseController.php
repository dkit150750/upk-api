<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        $courses = Course::select('id', 'title', 'description', 'background', 'picture')
            ->where('is_active', true)->orderByDesc('created_at')->get();
        return CourseResource::collection($courses);
    }

    public function store(): CourseResource
    {
        $picture = Course::getPictureDefaultPath();
        $course = Course::create([
            'picture' => $picture,
        ]);

        return new CourseResource($course);
    }

    public function show(Request $request, $id): CourseResource
    {
        $course = Course::select('id', 'title', 'description', 'background', 'picture')
            ->where('id', $id)
            ->where('is_active', true)
            ->with([
                'lectures' =>
                    function ($query) {
                        $query->where('is_active', true)
                            ->orderByDesc('date');
                    }
            ])
            ->firstOrFail();
        return new CourseResource($course);
    }

    public function update(Request $request, Course $course)
    {
        $course->update($request->all());
        return new CourseResource($course);
    }

    public function destroy(Course $course): CourseResource
    {
        $course->is_active = 0;
        $course->save();

        $lectures = $course->lectures;

        foreach ($lectures as $lecture) {
            $lecture->is_active = 0;
            $lecture->save();
        }

        return new CourseResource($course);
    }

    public function picture(Request $request, $id)
    {
            $course = Course::select('id', 'title', 'description', 'background', 'picture')
                ->where('id', $id)
                ->where('is_active', true)
                ->firstOrFail();
        try {
            $picture = $request->file('picture');
            $name = time();
            $courseId = $course->id;
            $course->createDir($courseId);
            $course->savePicture($picture, $name, $courseId);
            $pictureUrl = Storage::url("courses/{$courseId}/{$name}.webp");
            $course->picture = $pictureUrl;
            $course->save();
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 409);
        }
        return response()->json(['data' => $pictureUrl]);
    }

}
