<?php
namespace Model;
use Think\Model;
use Tools\Page;
class BookModel extends Model{

    /*
     * 获得首页推荐书籍数据
     */
    public function getRecommendBook(){
        $book=D('book');
        $readcount=D('read_count');

        $sql="select * from xs_read_count order BY rcount desc limit 3";
        $recommendBookId=$readcount->query($sql);
        $recommendBookIdStr=null;
        foreach($recommendBookId as $k => $v){
            $recommendBookIdStr.=$v['book_id'].',';
        }
        $recommendBookIdStr=rtrim($recommendBookIdStr,',');

        $sql="select id,book_name,book_img,book_desc,book_author,book_sign from xs_book where id in ($recommendBookIdStr)";
        //获得推荐的数目详情
        $res=$book->query($sql);

        for($i=0;$i<3;$i++){
            $res[$i]['book_desc']=str_replace('<p>','',$res[$i]['book_desc']);
            $res[$i]['book_desc']=str_replace('</p>','',$res[$i]['book_desc']);

            $bookSignArr=explode(' ',$res[$i]['book_sign']);

            $res[$i]['book_sign1']=$bookSignArr[1];

            $res[$i]['book_sign2']=$bookSignArr[2];

            $res[$i]['book_sign']=str_replace('</p>','',$res[$i]['book_desc']);
            unset($res[$i]['book_sign']);

        }
//        dump($res);
        return $res;

    }

    /*
     * 获得首页男生喜欢分类的书籍数据
     */
    public function getBoyLikeBook(){
        $BoyLikeBookSignArr=array('现代','搞笑','校园','黑帮');
        $radomSign=mt_rand(0,count($BoyLikeBookSignArr))%count($BoyLikeBookSignArr);
        $book=D('book');
        $sql="select id,book_name,book_img,book_desc,book_author,book_sign from xs_book where book_sign like '%{$BoyLikeBookSignArr[$radomSign]}%' limit 6";
        $res=$book->query($sql);
        return $res;
    }

    /*
     * 获得首页女生喜欢分类的书籍数据
     */

    public function getGirlLikeBook(){
        $girlLikeBookSignArr=array('豪门','穿越','爱情','搞笑');
        $radomSign=mt_rand(0,count($girlLikeBookSignArr))%count($girlLikeBookSignArr);
        $book=D('book');
        $sql="select id,book_name,book_img,book_desc,book_author,book_sign from xs_book where book_sign like '%{$girlLikeBookSignArr[$radomSign]}%' limit 6";
        $res=$book->query($sql);
        return $res;
    }

    /*
     * 获得一本书籍的数据
     */
    public function getOneBook($bookid){

        $book=D('book');
        $sql="select id,book_name,book_img,book_desc,book_author,book_sign from xs_book where id in($bookid) limit 1";
        $res=$book->query($sql);

        $res[0]['book_desc']=str_replace('<p>','',$res[0]['book_desc']);
        $res[0]['book_desc']=str_replace('</p>','',$res[0]['book_desc']);

        $bookSignArr=explode(' ',$res[0]['book_sign']);

        $res[0]['book_sign1']=$bookSignArr[1];

        $res[0]['book_sign2']=$bookSignArr[2];

        $res[0]['book_sign']=str_replace('</p>','',$res[0]['book_desc']);

        unset($res[0]['book_sign']);

        return $res;
    }

    /*
     * 获得多本书籍的数据
     */
    public function getBooks($books){
        $book=D('book');
        $sql="select id,book_name,book_author from xs_book where id in($books) limit 5";
        $res=$book->query($sql);
        return $res;
    }

    /*
     * 获得书籍的图片
     */
    public function getBooksImg($books){
        $book=D('book');
        $sql="select id,book_name,book_img from xs_book where id in($books) limit 3";
        $res=$book->query($sql);
        return $res;
    }

    /*
     * 获得最新书籍
     */
    public function getNewBooks(){
        $book=D('book');
        $sql="select id,book_name,book_img from xs_book order by last_update desc limit 3";
        $res=$book->query($sql);
        return $res;
    }

    /*
     * 获得书籍详情(全部信息)
     */
    public function getBookDetail($bookId){
        $book=D('book');
        $res=$book->limit(1)->select($bookId);
        return $res;
    }

    /*
     * 随机抽取同等类型的书籍
     */
    public function getBookRadom($bookType){
        $book=D('book');
        $res=$book->order('rand()')->field('id,book_img,book_name,book_len,book_type')->limit(3)->where("book_type = '$bookType'")->select();
        return $res;
    }


    /*
     * 获得搜索页面分页数据
     */
     public function getSeachData($keywords,$nowpage,$num){
         $page=new Page('book',array('id','book_author','book_name','book_img','is_over','book_desc'),"book_name like '%{$keywords}%'");
         $page->pageCount=$num;
         $page->getPageCounts();
         $res=$page->returnPageData($nowpage);
         return $res;
     }

    public function getNewBooks2(){
        $book=D('book');
        $sql="select id,book_name,book_img from xs_book order by last_update desc limit 5";
        $res=$book->query($sql);
        return $res;
    }

    //获得不同分类的分页内容
    public function getCategoryData($bookType,$nowpage,$num,$type){
        if($type==1) {
            $page = new Page('book', array('id', 'book_author', 'book_name', 'book_img', 'is_over', 'book_desc'), "book_type like '%{$bookType}%'");
        }elseif($type==2){
            $page = new Page('book', array('id', 'book_author', 'book_name', 'book_img', 'is_over', 'book_desc'), "book_type like '%{$bookType}%'",'id desc');
        }elseif($type==3){
            $page = new Page('book', array('id', 'book_author', 'book_name', 'book_img', 'is_over', 'book_desc'), "book_type like '%{$bookType}%' and is_over=1");
        }elseif($type==4){
            $page = new Page('book', array('id', 'book_author', 'book_name', 'book_img', 'is_over', 'book_desc'), "book_type like '%{$bookType}%' and is_over=2");
        }
        $page->pageCount=$num;
        $page->getPageCounts();
        $res=$page->returnPageData($nowpage);
        return $res;
    }

    //获得收藏页面的分页数据
    public function getCollectData($nowpage,$num,$uid){
        $page=new Page('collect',array('id','uid','book_id','chapter_id','time'),"uid={$uid}",'time desc');
        $page->pageCount=$num;
        $page->getPageCounts();
        $res=$page->returnPageData($nowpage);
        return $res;
    }

    //获得用户收藏数目最多的书籍
    public function getMostCollectBooks(){
        $arr=array();
        $collectModel=D('collect');
        $sql="select count(*) as num ,xs_collect.book_id from xs_collect group by book_id order by num desc limit 5";
        $res=$collectModel->query($sql);
        for($i=0;$i<count($res);$i++){
            $arr[$i]=$this->getBookAppointDetail('id,book_name',$res[$i]['book_id'])[0];
            $arr[$i]['num']=$res[$i]['num'];
        }
        return $arr;
    }

    //获得关于字数长短的5本小说
    //param int $type 1 为字数最长的小说 0 为字数最少小说
    public function getMostLengthBooks($type=1){
        $bookModel=D('book');
        if($type==1) {
            $sql = "select id,book_name,book_len from xs_book order by book_len desc limit 5";
        }else{
            $sql = "select id,book_name,book_len from xs_book order by book_len asc limit 5";
        }
        return $bookModel->query($sql);
    }

    //获得最近更新的5本小说
    public function getMostUpdateBooks(){
        $bookModel=D('book');
        $sql="select id,book_name,last_update from xs_book order by last_update desc limit 5";
        return $bookModel->query($sql);
    }

    public function getBookAppointDetail($str='*',$bookId){
        $bookModel=D('book');
        return $bookModel->field("$str")->where("id=$bookId")->limit(1)->select();
    }

}