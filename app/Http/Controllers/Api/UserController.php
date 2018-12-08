<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
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

    public function balance()
    {
        return response()->json([
            'balance' => (int) auth()->user()->balance
        ]);
    }

    public function addBalance(Request $request)
    {
        $credits = $this->validate($request, [
            'to_be_added' => 'required|numeric'
        ]) ['to_be_added'];

        $request->user()->addBalance($credits);

        return response()->json([
            'balance' => (int) $request->user()->balance
        ]);
    }
}
