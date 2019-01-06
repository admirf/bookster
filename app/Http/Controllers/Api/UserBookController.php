<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Controllers\Controller;

class UserBookController extends Controller
{
    public function __invoke(User $user)
    {
        return BookResource::collection(
            $user->latestBooks
                ->load('category')
                ->load('media')
        );
    }

    public function books()
    {
        return BookResource::collection(
            auth()->user()->latestBooks
                ->load('category')
                ->load('media')
        );
    }
}
