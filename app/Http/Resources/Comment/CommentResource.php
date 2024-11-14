<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'comment' => $this->comment,
            'user_image' =>$this->user->image,
            'user_name' =>$this->user->name,
            'comment_data' =>$this->created_at->diffForHumans(),

        ];
    }
}
