<?php

namespace App\Http\Resources\notification;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'notify_type'=>$this->notifiable_type,
            'username'=>$this->data['username'],
            'post_title'=>$this->data['post_title'],
            'comment'=>$this->data['comment'],
            'post_slug'=>$this->data['post_slug'],
            'link'=>route('api.posts.show',$this->data['post_slug']).'?notify='. $this->id,
            'created_at'=>$this->created_at->diffForHumans(),

        ];
    }
}
