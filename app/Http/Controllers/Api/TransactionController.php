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
        return TransactionResource::collection(auth()->user()->transactions->load('book'));
    }

    public function show(Transaction $transaction)
    {
        $this->authorize('view', $transaction);

        return new TransactionResource($transaction->load('buyer')->load('book'));
    }

    public function complete(Transaction $transaction)
    {
        $this->authorize('complete', $transaction);

        $transaction->complete();
    }
}
