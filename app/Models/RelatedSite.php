<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedSite extends Model
{
    use HasFactory;

    protected $table = 'related_sites';
    protected $fillable = ['name', 'url','created_at','updated_at'];

    public static function filterRequest() :array
    {
        return [
            'name'=> 'required|string|min:3|max:50',
            'url'=> 'required|url',
        ];
    }



}
