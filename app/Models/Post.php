<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory,Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $table = 'posts';
    protected $fillable = ['id',
        'title',
        'desc',
        'small_desc',
        'comment_able',
        'slug',
        'user_id',
        'status',
        'category_id',
        'created_at',
        'updated_at'];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'post_id', 'id')->orderBy('created_at', 'desc');
    }

    public function images(){
        return $this->hasMany(Image::class, 'post_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}