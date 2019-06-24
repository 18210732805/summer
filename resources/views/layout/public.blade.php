<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy">
        <title>laravel for blog</title>
        <!-- Bootstrap core CSS -->
        <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="/css/blog.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/css/wangEditor.min.css">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]--></head>

    <body>
        <!--header头部-->
        @include('layout.header')
        <div class="container">

            <!-- 顶部空白条 -->
            @include('layout.kongbai')

            <!-- 主体区域 -->
            <div class="row">

                {{--这里是提示成功信息的判断--}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- 左侧区域 -->
                @section('main')@show

                <!-- 右侧区域 -->
                @include('layout.sidebar')

            </div>
        </div>
        <!-- /.row -->
        <!-- /.container -->
        <!-- footer底部区域 -->
        @include('layout.footer')

        <!-- Bootstrap core JavaScript==================================================- ->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/wangEditor.min.js"></script>
        <script src="/js/ylaravel.js"></script>
        <script>
            setInterval(function(){

                $('.alert-success').fadeOut();

            }, 3000)
        </script>
        <script src="/js/destroy.js"></script>
        <script src="/js/like.js"></script>

    </body>

</html>
