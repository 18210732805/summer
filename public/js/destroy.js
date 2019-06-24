$(function(){

    //1.获取删除文章的按钮，并添加单击事件
    $('.destroy').click(function(){

        //2.获取文章id
        var id = $(this).attr('id');

        //3.获取token
        var token = $(this).attr('token');

        //4.发送ajax请求
        $.post("/posts/"+id, {'_token':token,'_method':'DELETE'}, function(data){

            //5.判断是否成功
            if(data=='true'){

                //6.提示成功信息
                alert('恭喜，删除成功！');
                window.location.href='/posts';
            }else{
                alert('抱歉，删除失败！');
                window.location.href='/posts/'+id
            }
        });
    });

});
