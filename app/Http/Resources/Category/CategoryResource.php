<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /*return parent::toArray($request);*/
        $data =  [
            'category_name' =>$this->name,
            'category_slug' =>$this->slug,
            'category_status' =>$this->status(),
            'date' =>$this->created_at->diffForHumans(),

        ];
        if (!$request->is('api/posts/show/*') && $request->is('categories')){
            $data['posts'] = PostResource::collection($this->posts);
        }
        return $data;

    }
}
