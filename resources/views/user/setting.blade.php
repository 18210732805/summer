@extends('layout.public')

@section('main')
    <div class="col-sm-8 blog-main">
        <form class="form-horizontal" action="/user/{{\Auth::id()}}/setting" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-10">
                    <input class="form-control" name="name" type="text" value="{{\Auth::user()->name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">头像</label>
                <div class="col-sm-2">
                    <input class=" file-loading preview_input" type="file" name="photo">
                    @if(\Auth::user()->photo)
                        <img class="preview_img" src="/uploads/{{\Auth::user()->photo}}" alt="" class="img-rounded" style="border-radius:500px;width:150px;">
                    @else
                        <img class="preview_img" src="/image/user.jpeg" alt="" class="img-rounded" style="border-radius:500px;width:150px;">
                    @endif
                </div>
            </div>
            <button type="submit" class="btn btn-default">修改</button>
        </form>
        <br>

    </div>
@endsection
