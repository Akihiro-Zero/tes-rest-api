<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title' => $this->title,
            'isi' => $this->body,
            'published' => $this->created_at->format("d F Y"),
            'subject' => $this->subject->name,
            'author' => $this->user->name
        ];
        // return parent::toArray($request);
    }

    public function with($request)
    {
        return ['status' => 'succes'];
    }
}
