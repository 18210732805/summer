<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zan extends Model
{
    //设置允许通过zan模型进行添加的信息
    protected $fillable = [
        'post_id', 'user_id',
    ];
}
