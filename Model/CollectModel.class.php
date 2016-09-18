<?php
namespace Model;
use Think\Model;
class CollectModel extends Model{
    public function checkCollectExit($bookId,$uId){
           $collectModel=M('collect');
           return $collectModel->field('id')->where("uid={$uId} and book_id={$bookId}")->find()['id'];

    }
}