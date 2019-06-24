<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Post;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //加载专题详情页面的方法
    public function show(Topic $topic)
    {
        //1.查询当前专题下的文章数信息
        $topic = Topic::withCount('posts')->find($topic->id);

        //2.查询当前用户发布的所有的帖子，但是这些帖子不属于当前专题
        $free_posts = \App\Post::authorBy(\Auth::id())->topicNotBy($topic->id)->get();

        //3.查询当前专题下的所有帖子
        $posts = $topic->posts()->get();

        return view('topic/show', compact('topic','free_posts', 'posts'));
    }

    //执行投稿的方法
    public function submit($id)
    {
        //遍历添加信息
        foreach(request()->post_ids as $post_id){

            $pt = new \App\PostTopic;
            $pt->post_id = $post_id;
            $pt->topic_id = $id;
            $pt->save();
        }

        return back()->with('success', '投稿成功！');
    }
}
