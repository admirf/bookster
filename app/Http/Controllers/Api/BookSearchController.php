<?php

namespace App\Http\Controllers\Api;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Controllers\Controller;

class BookSearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = $this->validate($request, [
            'q' => 'required|string',
            'price_lte' => 'required_with:price_gte|integer',
            'price_gte' => 'required_with:price_lte|integer',
            'pages_lte' => 'required_with:pages_gte|integer',
            'pages_gte' => 'required_with:pages_lte|integer',
            'author' => 'sometimes|string',
            'available' => 'sometimes|in:true,false',
            'language' => 'sometimes|string'
        ]);

        $results = Book::search($query['q']);

        $results = isset($query['price_lte']) ? $results->whereBetween('price', [
            $query['price_gte'],
            $query['price_lte']
        ]): $results;

        $results = isset($query['pages_lte']) ? $results->whereBetween('num_of_pages', [
            $query['pages_gte'],
            $query['pages_lte']
        ]): $results;

        $results = isset($query['author']) ? $results->where('author', $query['author']): $results;
        $results = isset($query['language']) ? $results->where('language', $query['language']): $results;
        $results = isset($query['available']) ? $results->where('available', (bool) $query['available']): $results;

        return BookResource::collection(
            $results
                ->get()
                ->load('user')
                ->load('media')
                ->load('category')
        );
    }
}
