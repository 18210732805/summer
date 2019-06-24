<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Post extends Model
{
    //和用户模型建立了一个一对多反响关联
    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    //和评论模型建立一个一对多的关联
    public function comments()
    {
        return $this->hasMany('\App\Comment')->orderBy('created_at', 'desc');
    }

    //和点赞模型建立一个一对多的关联
    public function zans()
    {
        return $this->hasMany('\App\Zan');
    }

    //限定一个用户只能对一篇帖子点赞一次
    public function zan($user_id)
    {
        return $this->hasOne('\App\Zan')->where('user_id', $user_id);
    }

    //获取属于当前用户发布的帖子的方法
    public function scopeAuthorBy(Builder $query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

    //获取所有专题的列表
    public function post_topics()
    {
        return $this->hasMany('\App\PostTopic','post_id','id');
    }

    //获取不属于指定专题的帖子的方法
    public function scopeTopicNotBy(Builder $query, $topic_id)
    {
        return $query->doesntHave('post_topics','and', function($q) use ($topic_id){
            $q->where('topic_id', $topic_id);
        });
    }
}
