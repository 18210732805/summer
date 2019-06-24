$(function(){

    //1.获取按钮
    $('.like-button').click(function(e){

        //2.获取一下当前按钮
        var target = $(e.target);

        //3.获取 like-value 记录按钮状态的值
        var like_value = target.attr('like-value');

        //4.获取 like-user 当前被关注用户的id
        var like_user = target.attr('like-user');

        //5.获取 _token 用于做令牌验证的密文
        var _token = target.attr('_token');

        //6.判断我们是要关注还是要取关
        if(like_value==1){

            //7.发送 ajax 请求
            $.post('/user/'+like_user+'/fan', {'_token':_token}, function(data){

                //8.判断是否关注成功
                if(data=='true'){

                    //9.将状态码 like_value 的值设置成 0
                    target.attr('like-value', '0');

                    //10.将关注按钮变成取消关注
                    target.text('取消关注');
                }else{
                    window.location.href='/login'
                }

            });


        }else if(like_value==0){

            //7.发送 ajax 请求
            $.post('/user/'+like_user+'/unfan', {'_token':_token}, function(data){

                //8.判断是否关注成功
                if(data=='true'){

                    //9.将状态码 like_value 的值设置成 0
                    target.attr('like-value', '1');

                    //10.将关注按钮变成取消关注
                    target.text('关注');
                }else{
                    window.location.href='/login'
                }

            });

        }


    });

});
