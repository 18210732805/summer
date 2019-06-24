@extends('layout.public')

@section('main')
    <div class="col-sm-8 blog-main">
        {{--提示报错信息--}}
        @include('layout.error')

        <form action="/posts/{{$post->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{$post->title}}">
            </div>
            <div class="form-group">
                <label>内容</label>
                <textarea id="content" name="content" class="form-control" style="height:400px;max-height:500px;"  placeholder="这里是内容">{{$post->content}}</textarea>
            </div>
            <input type="hidden" name="updated_at" value="{{date('Y-m-d H:i:s')}}">
            <button type="submit" class="btn btn-default">提交</button>
        </form>
        <br>
            </div>
@endsection
