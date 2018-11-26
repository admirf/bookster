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
        return [
            'type' => 'book',
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'price' => (double) $this->price,
            'edition' => $this->edition,
            'language' => $this->language,
            'description' => $this->description,
            'isbn' => $this->isbn,
            'available' => (bool) $this->available,
            'user' => new UserResource($this->whenLoaded('user')),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'thumbnail' => $this->getFirstMediaUrl('default', 'thumb'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'media' => MediaResource::collection($this->whenLoaded('media'))
        ];
    }
}
