<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\LectureResource;
use App\Models\Lecture;
use Illuminate\Http\Request;

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
}
