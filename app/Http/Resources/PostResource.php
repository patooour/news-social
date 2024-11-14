<?php

namespace App\Http\Resources;

use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Comment\CommentCollection;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
/*        return parent::toArray($request);*/

        $data =  [
            'title'=>$this->title,
            'slug'=>$this->slug,
            'num_of_views'=>$this->num_of_views,

            'status'=>$this->status(),
            'date'=>$this->created_at->format('d-m-Y'),
            'Publisher'=>$this->user_id == null ? new AdminResource($this->admin)
                : new UserResource($this->user),

            'post_url'=>route('fronted.post.show' ,$this->slug),
            'images'=>ImageResource::collection($this->images),
            'category_name'=> $this->category->name,

        ];
        if ($request->is('api/posts/show/*')){
            $data['comment_able'] = $this->comment_able == 1 ? 'active' : 'not active';
            $data['small_desc'] = $this->small_desc;
            $data['category'] = new CategoryResource($this->category);
            $data['comments'] = new CommentCollection($this->comments);

        }
        return $data;
    }
}
