@extends('layout.public')

@section('main')
<div class="col-sm-8 blog-main">
    <div>
        <div id="carousel-example" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example" data-slide-to="1"></li>
                <li data-target="#carousel-example" data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="/image/1.jpg" alt="..." />
                    <div class="carousel-caption">...</div></div>
                <div class="item">
                    <img src="/image/1.jpg" alt="..." />
                    <div class="carousel-caption">...</div></div>
                <div class="item">
                    <img src="/image/1.jpg" alt="..." />
                    <div class="carousel-caption">...</div></div>
            </div>
            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
            </a>
            <a class="right carousel-control" href="#carousel-example" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
            </a>
        </div>
    </div>
    <div style="height: 20px;"></div>
    <div>
    @foreach($posts as $post)
        <div class="blog-post">
            <h2 class="blog-post-title">
                <a href="/posts/{{$post->id}}">{{$post->title}}</a></h2>
            <p class="blog-post-meta">{{$post->created_at->toFormattedDateString()}} by
                <a href="/user/{{$post->user->id}}">{{$post->user->name}}</a></p>
            <p>{!! Str::limit($post->content, 100, '... <a href="/posts/'.$post->id.'">查看全文</a>') !!}
                <p class="blog-post-meta">赞 {{$post->zans_count}} | 评论 {{$post->comments_count}}</p>
        </div>
    @endforeach

    {{$posts->links()}}
    </div>
</div>
@endsection
