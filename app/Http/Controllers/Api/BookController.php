<?php

namespace App\Http\Controllers\Api;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        return BookResource::collection(
            Book::with('user')
                ->with('category')
                ->paginate(20)
        );
    }

    public function show(Book $book)
    {
        return new BookResource(
            $book
                ->load('user')
                ->load('category')
        );
    }

    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|integer',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'description' => 'nullable|string',
            'isbn' => 'nullable|string|max:255',
            'edition' => 'nullable|string',
            'num_of_pages' => 'nullable|integer',
            'language' => 'required|string'
        ]);

        $book = $request->user()->books()->create($attributes);

        return (new BookResource($book))->response()->setStatusCode(201);
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('owns', $book);

        $attributes = $this->validate($request, [
            'category_id' => 'sometimes|integer|exists:categories,id',
            'price' => 'sometimes|integer',
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'isbn' => 'sometimes|string|max:255',
            'edition' => 'sometimes|string',
            'num_of_pages' => 'sometimes|integer',
            'language' => 'sometiems|string'
        ]);

        $book->fill($attributes)->save();

        return new BookResource(
            $book
                ->load('user')
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
