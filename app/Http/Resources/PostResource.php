<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
		return [
			// Does not return ID or timestamp data (assumed should not be public)
			'url' => $this->url,
			'title' => $this->title,
			'description' => $this->description,
			'tags' => $this->tags,
		];
    }
}
