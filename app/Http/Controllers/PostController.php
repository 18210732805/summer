<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogPost;
use App\Post;
use App\Zan;
use App\Policies\PostPolicy;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //1.使用Eloquent模型进行查询
        $posts = Post::orderBy('created_at','desc')->withCount('comments')->withCount('zans')->paginate(5);

        //2.加载网站首页，并分配数据到模板中
        return view('post/index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //1.加载文章发布页面
        return view('post/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        //1.逻辑
        //$res = Post::insert($request->except('_token'));
        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = \Auth::id();
        $post->save();

        //2.渲染(响应)
        return redirect('/posts')->with('success','恭喜，文章发布成功！');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //加载文章详情页面
        return view('post/show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post/edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogPost $request, Post $post)
    {
        //1.使用策略类验证
        $this->authorize('update', $post);

        //2.逻辑
        //$res = Post::where('id',$id)->update($request->except(['_token','_method']));
        $post->title = request('title');
        $post->content = request('content');
        $post->save();

        //3.渲染
        return redirect('/posts/'.$post->id)->with('success', '恭喜，修改成功！');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $res = $post->delete();

        if($res){
            return 'true';
        }else{
            return 'false';
        }
    }

    /**
     * reply the post
     */
    public function comment(Request $request)
    {
        //1.验证
        $request->validate([
            'content' => 'required|min:15|max:100'
        ]);

        //2.逻辑
        $comment = new \App\Comment;
        $comment->user_id = \Auth::id();
        $comment->post_id = $request->post_id;
        $comment->content = $request->content;
        $comment->save();

        //3.渲染
        return back()->with('success','留言成功！');
    }

    /**
     * zan a post
     */
    public function zan($id)
    {
        /*//验证

        //逻辑
        $zan = new Zan;
        $zan->user_id = \Auth::id();
        $zan->post_id = $id;
        $zan->save();

        //渲染
        return back()->with('success', '点赞成功！');*/

        //准备信息
        $params = [
            'post_id' => $id,
            'user_id' => \Auth::id(),
        ];

        //如果是第一条，则添加；如果已存在，则查询
        Zan::firstOrCreate($params);

        //渲染
        return back()->with('success', '点赞成功！');
    }

    /**
     * unzan a post
     */
    public function unzan(Post $post)
    {
        /*//逻辑
        Zan::where('post_id',$id)->where('user_id',\Auth::id())->delete();

        //渲染
        return back()->with('success', '取消赞成功！');*/

        //逻辑
        $post->zan(\Auth::id())->delete();

        //渲染
        return back()->with('success', '取消赞成功！');
    }

}
