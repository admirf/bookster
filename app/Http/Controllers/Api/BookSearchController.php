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
            'price_gte' => 'required_with:price_lte|integer'
        ]);

        $results = Book::search($query['q']);

        $results = isset($query['price_lte']) ? $results->whereBetween('price', [
                $query['price_gte'],
                $query['price_lte']
            ]
        ): $results;

        return BookResource::collection(
            $results
                ->get()
                ->load('user')
                ->load('media')
                ->load('category')
        );
    }
}
