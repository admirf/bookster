<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Transaction extends Model
{
    protected $fillable = [
        'book_id',
        'buyer_id',
        'credits',
        'completed'
    ];

    protected $dates = [
        'completed_at',
        'created_at',
        'updated_at'
    ];

    public function scopeCompleted(Builder $query)
    {
        return $query->where('completed', true);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class);
    }

    public function complete()
    {
        $this->completed = true;
        $this->completed_at = Carbon::now();
        $this->save();
    }
}
