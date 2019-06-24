<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //判断某个用户是否已经被关注
    public function hasFan($user_id)
    {
        return $this->hasOne('\App\Fan', 'star_id', 'id')->where('fan_id', $user_id)->count();
    }

    //建立和文章表的关联
    public function posts()
    {
        return $this->hasMany('\App\Post')->orderBy('created_at','desc');
    }

    //建立和粉丝表的关联，获取当前用户所有的关注列表
    public function stars()
    {
        return $this->hasMany('\App\Fan','fan_id','id');
    }

    //建立和粉丝表的关联，获取当前用户所有的粉丝列表
    public function fans()
    {
        return $this->hasMany('\App\Fan', 'star_id', 'id');
    }
}
