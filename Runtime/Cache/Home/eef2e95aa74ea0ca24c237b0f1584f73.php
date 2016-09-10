<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title><?php echo ($username); ?>的个人中心</title>
    <!--<link rel="stylesheet" type="text/css" href="http://static.zongheng.com/h5/v2/css/mobile.css">-->
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>collect.css" />
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>person.css" />
    <script type="text/javascript" src="<?php echo (JS_URL); ?>jquery.min.js"></script>

</head>
<body>
   <div class="head" style="background-image:url('<?php echo (IMG_URL); ?>back<?php echo mt_rand(1,3); ?>.jpg')"></div>
   <div class="logo"><img id="default" src="<?php echo (IMG_URL); ?>defaultImage.png" width="90px" style="border-radius: 45px;"></div>
   <div class="name"><?php echo ($username); ?></div>
   <div class="menu">
       <ul>
           <li onclick="location.href='/Home/Index/index'">首页</li>
           <li onclick="location.href='/Home/Book/rank.html'" style="margin-left: 10%">排行榜</li>
           <li id="collect">我的收藏</li>
           <li id="info" style="margin-left: 10%">个人信息</li>
           <li>我的书币</li>
           <li onclick="location.href='/Home/User/logOutAction.html'" style="margin-left: 10%">退出登录</li>
       </ul>
   </div>
   <!--个人信息页面-->
   <div class="personInfo">
       <div class="close"><img src="<?php echo (IMG_URL); ?>xx.png" width="20px"></div>
        <ul>
           <li><i class="iconfont">&#xe609;</i> 加入时间:　<b><?php echo ($addtime); ?></b></li>
           <li><i class="iconfont">&#xe67e;</i> 联系方式:　<b><?php echo ($tel); ?></b></li>
           <li><i class="iconfont">&#xe61f;</i> 邮　　箱:　<b><?php echo ($email); ?></b></li>
        </ul>
   </div>

   <!--收藏的书籍页面-->
   <div class="collect">
       <div class="close"><img src="<?php echo (IMG_URL); ?>xx.png" width="20px"></div>

   </div>
</body>
</html>

<script type="text/javascript">
    $().ready(function(){
        var username='<?php echo ($username); ?>';
        $.ajax({
            type:'post',
            url:'/Home/User/getUserLogo.html',
            data:'username='+username,
            success:function(msg){
                if(msg.code!=404) {
                    if (msg.code == 200) {
                        $('#default').remove();
                        console.log(msg);
                        var div= $('<div></div>');
                        div.css({
                            'width':'90px',
                            'height':'90px',
                            'backgroundColor':'rgb('+Math.random()*255+','+Math.random()*255+','+Math.random()*255+')',
                            'position': 'relative',
                            'left': '50%',
                            'marginLeft': '-45px',
                            'height': '90px',
                            'borderRadius': '45px',
                            'textAlign': 'center',
                            'lineHeight': '90px',
                            'backgroundColor':'rgb('+ parseInt(Math.random()*254) +','+ parseInt(Math.random()*254) +','+ parseInt(Math.random()*254) +')',
                            'fontSize':'25px',
                            'color':'white'
                        });
                        div.html(msg.data.data);
                        $('.logo').append(div);
                    } else {
                        $('#default').attr('src', msg.data.data);
                    }
                }
            }
        });
        $('#info').bind('click',function(){
            $('.menu').hide();
             $('.personInfo').slideDown(500);
        });
        $('.close').bind('click',function(){
            $(this).parent().hide();
            $('.menu').slideDown(500);
        });
        $('#collect').bind('click',function(){
                 //如果从菜单点击的话必须清除元素内容
                 $('.collect').children(":not('.close')").remove();
                 getCollectData(1);
        });

        function getCollectData(page){
            $('.menu').hide();
            $.ajax({
                type:'post',
                url :'/Home/Book/getSaveBookByDb.html',
                dataType:'json',
                data:'page='+page,
                success:function(msg){

                    if(msg==''){
                        var html='<div style="text-align: center;margin-top:150px;border-bottom: 1px solid gray">您还没有收藏书籍哦 赶快去首页看书吧</div>'
                        $('.collect').append(html);
                    }else {
                        $(msg).each(function (i, item) {
                            var html = ' <div class="bookbox" bookid="' + item.book_id + '" chapterid="' + item.chaoter_id + '" _link="/Home/Book/reading.html?bookId=' + item.book_id + '&chapterId=' + item.chapter_id + '">   <div class="bookimg"><img src="' + item.book_img + '" orgsrc=""></div>   <div class="bookinfo">   <h4 class="bookname"><i class="iTit">' + item.book_name + '</i>   </h4>   <div class="info">   <span>作者：</span>' + item.author + '<br>   <span>最新：</span>' + item.new_chapter + '<br>    <span>已读到： </span>' + item.title + '<br/><span>收藏时间:  </span>' + item.time + '</div></div><div class="delbutton"><a class="del_but" cid="'+item.id+'" data-num="0">删除</a></div></div>';
//                        var inhtml='<span>作者：</span>'+item.author+'<br>   <span>最新：</span>'+item.new_chapter+'<br>    <span>已读到： </span>'+item.title;
//                        $('.bookbox').attr('bookid',item.book_id);
//                        $('.bookbox').attr('chapterid',item.chapter_id);
//                        $('.bookbox').attr('_link','/Home/Book/reading.html?bookId='+item.book_id+'&chapterId='+item.chapter_id);
//                        $('.bookimg > img').attr('src',item.book_img);
//                        $('.bookimg > img').attr('src',item.book_img);
//                        $('.bookname > i').html(item.bookname);
                            $('.collect').append(html);
                        })
                        if(msg.length<5){
                            var more='<div id="no_more" class="sbut"><span class="view_more">木有更多了( ˙﹏˙ )</span></div>';

                            $('.collect').append(more);
                        }else{
                            var more='<div id="view_more" class="sbut"><span class="view_more">查看更多</span></div>';
                            $('.collect').append(more);
                            $('#view_more').bind('click',function(){
                                $(this).remove();
                                getCollectData(page+1);
                            });
                        }
                    }
                    $('.collect').slideDown(500);
                    $('.bookbox').bind('click',function(){
                        location.href=$(this).attr('_link');
                    });
                    $('.del_but').bind('click',function(event){
                        var cid=$(this).attr('cid');
                        var ob=$(this);
                        $.ajax({
                            type:'post',
                            data:'cid='+cid,
                            url :'/Home/Book/delSaveBookByDb.html',
                            dataType:'json',
                            success:function(msg){
                                if(msg.code==200){
                                    ob.parent().parent().remove();
                                }else{
                                    alert(msg.msg);
                                }
                            }
                        });
                        event.stopPropagation();
                    });
                }
            });
        }


    })

</script>