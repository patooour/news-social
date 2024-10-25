<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedSite extends Model
{
    use HasFactory;

    protected $table = 'related_sites';
    protected $fillable = ['name', 'url','created_at','updated_at'];
}
