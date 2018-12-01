<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all()->load('books')->load('books.media'));
    }

    public function show(User $user)
    {
        return new UserResource($user->load('books')->load('books.media'));
    }
}
