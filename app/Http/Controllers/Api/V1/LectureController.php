<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LectureResource;
use App\Http\Resources\UserResource;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LectureController extends Controller
{

    public function store(Request $request): LectureResource
    {
        $lecture = Lecture::create($request->all());
        return new LectureResource($lecture);
    }

    public function destroy(Lecture $lecture): LectureResource
    {
        $lecture->is_active = 0;
        $lecture->save();
        return new LectureResource($lecture);
    }

    public function users(int $lecture): AnonymousResourceCollection
    {
        $users = Lecture::findOrFail($lecture)->users;
        return UserResource::collection($users);
    }
}
