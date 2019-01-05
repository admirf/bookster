<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'type' => 'report',
            'title' => $this->title,
            'content' => $this->content,
            'user' => new UserResource($this->whenLoaded('user'))
        ];
    }
}
