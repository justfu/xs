<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $recommendBook=$this->getRecommendBook();
        $boyLikeReadBook=$this->getBoyLikeBook();
        $girlLikeReadBook=$this->getGirlLikeBook();
        $this->assign('recommendBook',$recommendBook);
        $this->assign('boyLikeReadBook',$boyLikeReadBook);
        $this->assign('girlLikeReadBook',$girlLikeReadBook);
        $this->display();
    }

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

    public function getBoyLikeBook(){
        $BoyLikeBookSignArr=array('现代','搞笑','校园','黑帮');
        $radomSign=mt_rand(0,3)%count($BoyLikeBookSignArr);
        $book=D('book');
        $sql="select id,book_name,book_img,book_desc,book_author,book_sign from xs_book where book_sign like '%{$BoyLikeBookSignArr[$radomSign]}%' limit 6";
        $res=$book->query($sql);
        return $res;
    }

    public function getGirlLikeBook(){
        $BoyLikeBookSignArr=array('豪门','穿越','爱情','黑帮');
        $radomSign=mt_rand(0,3)%count($BoyLikeBookSignArr);
        $book=D('book');
        $sql="select id,book_name,book_img,book_desc,book_author,book_sign from xs_book where book_sign like '%{$BoyLikeBookSignArr[$radomSign]}%' limit 6";
        $res=$book->query($sql);
        return $res;
    }
}
