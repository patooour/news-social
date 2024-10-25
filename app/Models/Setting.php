<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = ['id',
        'site_name',
        'favicon',
        'logo',
        'facebook',
        'youtube',
        'instagram',
        'twitter',
        'country',
        'city',
        'street',
        'email',
        'phone',
        'created_at',
        'updated_at'];
}
