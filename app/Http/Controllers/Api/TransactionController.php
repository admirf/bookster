<?php

namespace App\Http\Controllers\Api;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;

class TransactionController extends Controller
{
    public function index()
    {
        return TransactionResource::collection(auth()->user()->transactions->load('books'));
    }

    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);

        return new TransactionResource($transaction->load('buyer')->load('books')->load('books.user'));
    }

    public function complete(Transaction $transaction)
    {
        $this->authorize('complete', $transaction);

        $transaction->complete();
    }
}
