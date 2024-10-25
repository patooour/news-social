<?php

namespace App\Livewire\Admin;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class LatestPostsComments extends Component
{
    public function render()
    {
        $latest_posts = Post::withcount('comments')->active()->latest()->take(5)->get();
        $latest_comments = Comment::with(['user','post'])->latest()->take(5)->get();
        return view('livewire.admin.latest-posts-comments',[
            'latest_posts' => $latest_posts,
            'latest_comments' => $latest_comments
            ]);
    }
}
