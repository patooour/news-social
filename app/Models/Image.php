<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';
    protected $fillable = [
        'id',
        'path',
        'post_id',
        'created_at',
        'updated_at'];
    public function post(){
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
