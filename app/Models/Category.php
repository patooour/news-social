<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Category extends Model
{
    use HasFactory,Sluggable;

    protected $table = 'categories';
    protected $fillable = ['id',
        'name',
        'slug',
        'status',
        'created_at',
        'updated_at'];

    public function posts(){
        return $this->hasMany(Post::class, 'category_id', 'id');
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
