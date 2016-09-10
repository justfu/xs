<?php
namespace Model;
use Think\Model;
class BookListModel extends Model{
    public function getMostNewChapter($bookId){
        $list=D('book_list');
        return $list->field('id,title,addtime')->where("book_id=$bookId")->order('id desc')->limit(1)->select();
    }

    /*
     * 获得当前书籍的前六章数据的标题
     * @param int $bookId 当前书籍的book_id
     * @param int $type 返回章节排序 0返回前六章 1 返回最后六章
     * @return 返回章节数据
     */
    public function getSixChapter($bookId,$type){
        $list=D('book_list');
        $type=$type?'desc':'asc';
        return $list->field('id,title,len,book_id')->where("book_id=$bookId")->order("id $type")->limit(5)->select();
    }

    /*
     * 获得当前书籍的章节数量
     */
    public function getChapterCount($bookId){
        $list=D('book_list');
        return $list->field('count(*)')->where("book_id=$bookId")->select();
    }

    /*
     * 获得章节的目录信息
     */

    public function getChapterList($bookId){
        $list=D('book_list');
        return $list->field('id,title,book_id')->where("book_id=$bookId")->select();
    }

   public function getChapterContent($bookId,$bookListId){
       $list=D('book_list');
       return $list->field('id,title,book_id,content')->where("book_id=$bookId and id=$bookListId")->limit(1)->select();
   }

    public function getFirstChapterIdByBookId($bookId){
        $list=D('book_list');
        return $list->field('id')->where("book_id=$bookId")->limit(1)->select();
    }

    public function checkChapterExist($chapterId){
        $list=D('book_list');
        return $list->field('count(*)')->where("id=$chapterId")->limit(1)->select()[0]['count(*)']?TURE:FALSE;
    }

    /*
     * 获得当前bookid的最后一个章节的书
     */
    public function getLastChapter($bookId){
        $list=D('book_list');
        return $list->field('title')->where("book_id=$bookId")->order('id desc')->limit(1)->find();
    }

    //获得章节信息
    public function getChapterInfo($chapterId){
        $list=D('book_list');
        return $list->field('title')->where("id=$chapterId")->limit(1)->find();
    }

}