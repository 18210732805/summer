@extends('layout.public')

@section('main')
    <div class="col-sm-8 blog-main">
        {{--提示报错信息--}}
        @include('layout.error')

        <form action="/posts" method="POST">
            @csrf
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题">
            </div>
            <div class="form-group">
                <label>内容</label>
                <textarea id="content"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容"></textarea>
            </div>
            <input type="hidden" name="created_at" value="{{date('Y-m-d H:i:s')}}">
            <input type="hidden" name="updated_at" value="{{date('Y-m-d H:i:s')}}">
            <button type="submit" class="btn btn-default">提交</button>
        </form>
        <br>

    </div>
@endsection
