<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Mail\AdminMail;
use App\Mail\UserMail;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\User;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RecordController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $lectures = $user->lectures()
            ->orderByDesc('id')
            ->with('course:id,title,picture,background')
            ->paginate(1);

        return response()->json(['data' => $lectures]);
    }

    public function store(Request $request): JsonResponse
    {
        $user = Auth::user();
        $userId = $user->id;

        $lecture = Lecture::find($request->lecture_id);

        if ($lecture->places === $lecture->total_places) {
            return response()->json(['data' => false]);
        }

        ++$lecture->places;
        $lecture->save();

        $lecture->users()->attach($userId);

        $course = Course::find($lecture->course_id);
        $data = [
            'course' => $course,
            'lecture' => $lecture,
        ];

        Mail::to($user->email)->send(new UserMail($data));

//        $data['user'] = $user;
//        $email = config('app.mailers.smtp.username');
//        Mail::to($email)->send(new AdminMail($data));

        return response()->json(['data' => true]);
    }

    public function hasRecord(Request $request): JsonResponse
    {
        $lecture_id = $request->lecture_id;
        $lecture = Lecture::find($lecture_id);

        if (!$lecture->is_active) {
            return response()->json(['data' => true, 'message' => 'Запись неактивна']);
        }

        $user = Auth::user();
        $userId = $user->id;


        $record = DB::table('lecture_user')
            ->where('lecture_id', $lecture_id)
            ->where('user_id', $userId)
            ->get();

        if (count($record) > 0) {
            return response()->json(['data' => true, 'message' => 'Вы уже записаны']);
        }

        return response()->json(['data' => false]);
    }
}
