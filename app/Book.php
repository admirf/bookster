<?php

namespace App;

use ScoutElastic\Searchable;
use Illuminate\Database\Eloquent\Model;
use App\Configuration\BookIndexConfigurator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes, Searchable;

    protected $indexConfigurator = BookIndexConfigurator::class;

    protected $fillable = [
        'category_id',
        'title',
        'author',
        'language',
        'num_of_pages',
        'edition',
        'description',
        'price',
        'available',
        'isbn'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
