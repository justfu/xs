<?php
namespace Model;
use Think\Model;

class ReadCountModel extends Model{

    /*
     * 取得阅读文章次数
     */
    public function getReadCount($bookId){
        $readCount=D('read_count')->field("rcount")->where("book_id=$bookId")->select();
        return $readCount[0]['rcount'];
    }
}