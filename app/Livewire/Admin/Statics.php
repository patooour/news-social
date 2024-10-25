<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class Statics extends Component
{
    public function render()
    {
        $categories  = Category::active()->count();
        $posts  = Post::active()->count();
        $Comments  = Comment::count();
        $users  = User::active()->count();
        return view('livewire.admin.statics',[
            'categories' => $categories,
            'posts' => $posts,
            'comments' => $Comments,
            'users' => $users
        ]);
    }
}
