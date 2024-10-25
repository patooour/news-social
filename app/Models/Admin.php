<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory,Notifiable;

    protected $table = 'admins';
    protected $fillable = ['id',
        'name',
        'email',
        'password',
        'role_id',
        'status',
        'username',
        'created_at',
        'updated_at'];


    protected $guard = 'admin';

    public function posts(){
        return $this->hasMany(Post::class, 'admin_id', 'id');
    }
    public function role(){
        return $this->belongsTo(Authorization::class, 'role_id', 'id');
    }

    public function hasRole($permission){
        $auth = $this->role;

        foreach($auth->permissions as $role){
            if($role == $permission ?? false){
                return true;
            }
        }
    }


}
