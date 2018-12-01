<?php

namespace App\Http\Controllers\Api;

use App\Book;
use App\Http\Resources\BookResource;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;

class BookController extends Controller
{
    public function index()
    {
        return BookResource::collection(
            Book::with('user')
                ->with('media')
                ->with('category')
                ->paginate(20)
        );
    }

    public function show(Book $book)
    {
        return new BookResource(
            $book
                ->load('user')
                ->load('media')
                ->load('category')
        );
    }

    public function store(BookStoreRequest $request)
    {
        $book = $request->user()->books()->create($request->validated());

        return (new BookResource($book))->response()->setStatusCode(201);
    }

    public function update(BookUpdateRequest $request, Book $book)
    {
        $this->authorize('owns', $book);

        $book->fill($request->validated())->save();

        return new BookResource(
            $book
                ->load('user')
                ->load('media')
                ->load('category')
        );
    }

    public function destroy(Book $book)
    {
        $this->authorize('owns', $book);

        $book->delete();

        return response('', 204);
    }
}
