<?php

namespace App\Http\Controllers\Api;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Http\Controllers\Controller;

class BookSearchController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function __invoke(Request $request)
    {
        $query = $this->validate($request, [
            'q' => 'required|string',
            'price_lte' => 'sometimes|integer',
            'price_gte' => 'sometimes|integer',
            'pages_lte' => 'sometimes|integer',
            'pages_gte' => 'sometimes|integer',
            'author' => 'sometimes|string',
            'available' => 'sometimes|in:true,false',
            'category' => 'sometimes|integer',
            'language' => 'sometimes|string'
        ]);

        $results = Book::search($query['q']);

        $results = isset($query['price_lte']) || isset($query['price_gte']) ? $results->whereBetween('price', [
            $query['price_gte'] ?? config('app.search.price_gte'),
            $query['price_lte'] ?? config('app.search.price_lte')
        ]): $results;

        $results = isset($query['pages_lte']) || isset($query['pages_gte']) ? $results->whereBetween('num_of_pages', [
            $query['pages_gte'] ?? config('app.search.pages_gte'),
            $query['pages_lte'] ?? config('app.search.pages_lte')
        ]): $results;

        $results = isset($query['author']) ? $results->where('author', $query['author']): $results;
        $results = isset($query['language']) ? $results->where('language', $query['language']): $results;
        $results = isset($query['category']) ? $results->where('category_id', $query['category']): $results;
        $results = isset($query['available']) ? $results->where('available', $query['available']): $results;

        $paginatedResults = $results->paginate(10);
        $paginatedResults->load('user')->load('media')->load('category');

        return BookResource::collection($paginatedResults);
    }
}
