<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAvatarRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function store(StoreAvatarRequest $request)
    {
        try {
            $avatar = $request->file('avatar');
            $name = time();
            $user = Auth::user();
            $userId = $user->id;
            $user->createDir($userId);
            $user->saveAvatar($avatar, $name, $userId);
            $user->avatar = Storage::url("avatars/{$userId}/{$name}.webp");
            $user->save();
        } catch (Exception $exception) {
            return response()->json(['message' => $exception->getMessage()], 409);
        }
        return new UserResource($user);
    }
}
