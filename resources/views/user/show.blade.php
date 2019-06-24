@extends('layout.public')

@section('main')
    <div class="col-sm-8">
        <blockquote>
            <p>
                @if($users->photo)
                    <img src="/uploads/{{$users->photo}}" alt="" class="img-rounded" style="border-radius:500px; height: 40px">
                @else
                    <img src="/image/user.jpeg" alt="" class="img-rounded" style="border-radius:500px; height: 40px">
                @endif
                {{$users->name}}
            </p>
            <footer>关注：{{$users->stars_count}}｜粉丝：{{$users->fans_count}}｜文章：{{$users->posts_count}}</footer>
            <br>
            <div>
            {{--判断当前用户是否和登录用户是同一个人，如果是同一个人，则不显示关注与取关按钮--}}
            @if($users->id!=\Auth::id())
                {{--判断当前用户是否已经被关注--}}
                @if($users->hasFan(\Auth::id()))
                    <button class="btn btn-default like-button" like-value="0" like-user="{{$users->id}}" _token="{{csrf_token()}}" type="button">取消关注</button>
                @else
                    <button class="btn btn-default like-button" like-value="1" like-user="{{$users->id}}" _token="{{csrf_token()}}" type="button">关注</button>
                @endif
            @endif
            </div>
        </blockquote>
    </div>
    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @foreach($users->posts as $post)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class=""><a href="/posts/{{$post->id}}" >{{$post->title}}</a>&nbsp;&nbsp;{{$post->created_at->diffForHumans()}}</p>
                            {!! Str::limit($post->content,100,'... <a href="/posts/'.$post->id.'">查看全文</a>') !!}
                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    @foreach($star_users as $user)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class=""><a href="/user/{{$user->id}}">{{$user->name}}</a></p>
                            <p class="">关注：{{$user->stars_count}} | 粉丝：{{$user->fans_count}}｜ 文章：{{$user->posts_count}}</p>

                            <div>
                                {{--判断当前用户是否和登录用户是同一个人，如果是同一个人，则不显示关注与取关按钮--}}
                                @if($user->id!=\Auth::id())
                                    {{--判断当前用户是否已经被关注--}}
                                    @if($user->hasFan(\Auth::id()))
                                        <button class="btn btn-default like-button" like-value="0" like-user="{{$user->id}}" _token="{{csrf_token()}}" type="button">取消关注</button>
                                    @else
                                        <button class="btn btn-default like-button" like-value="1" like-user="{{$user->id}}" _token="{{csrf_token()}}" type="button">关注</button>
                                    @endif
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    @foreach($fan_users as $user)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class=""><a href="/user/{{$user->id}}">{{$user->name}}</a></p>
                            <p class="">关注：{{$user->stars_count}} | 粉丝：{{$user->fans_count}}｜ 文章：{{$user->posts_count}}</p>

                            <div>
                                {{--判断当前用户是否和登录用户是同一个人，如果是同一个人，则不显示关注与取关按钮--}}
                                @if($user->id!=\Auth::id())
                                    {{--判断当前用户是否已经被关注--}}
                                    @if($user->hasFan(\Auth::id()))
                                        <button class="btn btn-default like-button" like-value="0" like-user="{{$user->id}}" _token="{{csrf_token()}}" type="button">取消关注</button>
                                    @else
                                        <button class="btn btn-default like-button" like-value="1" like-user="{{$user->id}}" _token="{{csrf_token()}}" type="button">关注</button>
                                    @endif
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>


    </div>
@endsection
