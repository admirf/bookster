<?php

namespace App\Http\Controllers\Api;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MediaResource;

class BookMediaController extends Controller
{
    public function index(Book $book)
    {
        return MediaResource::collection($book->getMedia());
    }

    /**
     * @param Request $request
     * @param Book $book
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function upload(Request $request, Book $book)
    {
        $this->authorize('owns', $book);

        $this->validate($request, [
            'image' => 'required|file'
        ]);

        $book
            ->addMedia($request->file('image'))
            ->toMediaCollection();
    }
}
