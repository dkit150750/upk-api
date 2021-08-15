<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function admin(int $user): JsonResponse
    {
        $user = User::find($user);
        $user->is_admin = !$user->is_admin;
        $user->save();
        return response()->json(['message' => $user->is_admin]);
    }
}
