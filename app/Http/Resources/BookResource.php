<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $thumb = $this->getFirstMediaUrl('default', 'thumb');

        return [
            'type' => 'book',
            'id' => $this->id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'author' => $this->author,
            'price' => (double) $this->price,
            'edition' => $this->edition,
            'num_of_pages' => (int) $this->num_of_pages,
            'language' => $this->language,
            'description' => $this->description,
            'isbn' => $this->isbn,
            'available' => (bool) $this->available,
            'user' => new UserResource($this->whenLoaded('user')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'thumbnail' => empty($thumb) ? '/storage/placeholder.jpg': $thumb,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'media' => MediaResource::collection($this->whenLoaded('media'))
        ];
    }
}
