<?php

namespace App;

use ScoutElastic\Searchable;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use App\Configuration\BookIndexConfigurator;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;


class Book extends Model implements HasMedia
{
    use SoftDeletes,
        Searchable,
        HasMediaTrait;

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

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * @param Media|null $media
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }
}
