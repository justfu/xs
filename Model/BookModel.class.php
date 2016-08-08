<?php
namespace Model;
use Think\Model;
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
        $girlLikeBookSignArr=array('豪门','穿越','爱情','黑帮');
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
        $res=$book->select($bookId);
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
}