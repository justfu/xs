<?php

/*
 * 取得当前时间于给定时间的时间差值,并且以多少天...形式返回
 * @param string $time 时间日期
 * @return string 指定形式返回
 */
function getTimeDifference($time){
    $nowtime=time().'<br/>';
    $time=strtotime($time);
    $difference=$nowtime-$time;
    $day=ceil($difference/1000/60/60/24);
    $hour=$difference/60/60%24;
    $minute=$difference/60%60;
    $second=$difference%60;
    if($day==0&&$hour==0&&$minute==0){
        return $second.'秒前';
    }elseif($day==0&&$hour==0){
        return $minute.'分钟前';
    }elseif($day==0){
        return $hour.'小时前';
    }else{
        return $day.'天前';
    }
}

function my_log($content)
{
    $logs = new Tools\LogModel();
    $data = array();
    $data['msg'] = $content;
    $logs->add($data);
}

function getLen($len){
    if($len>10000){
        return ceil($len/10000).'万字';
    }elseif($len>1000){
        return ceil($len/1000).'千字';
    }elseif($len>100){
        return ceil($len/100).'百字';
    }else{
        return $len.'字';
    }
}