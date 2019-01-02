<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\TransactionResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyController extends Controller
{
    public function __invoke(Request $request)
    {
        $books = $this->validate($request, [
            'books' => 'required|array',
            'books.*.id' => 'required|numeric',
            'credits' => 'required|numeric'
        ]);

        $transaction = $request->user()->buy(collect($books['books'])->map(function ($item, $key) {
            return $item['id'];
        }), $books['credits']);

        return new TransactionResource($transaction->load('books'));
    }
}
