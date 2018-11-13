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
            Book::all()
                ->load('user')
                ->load('category')
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

    public function update(Request $request, Book $book)
    {
        $attributes = $this->validate($request, [
            'category_id' => 'sometimes|integer|exists:category,id',
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
        $book->delete();

        return response('', 204);
    }
}
