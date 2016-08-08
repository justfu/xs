<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){

        $bookModel=new \Model\BookModel();
        $recommendBook=$bookModel->getRecommendBook();
        $boyLikeReadBook=$bookModel->getBoyLikeBook();
        $girlLikeReadBook=$bookModel->getGirlLikeBook();

        //获得校园种类的书
        $xyOneBook=$bookModel->getOneBook(2080);
        $xybooks='2092,2099,2119,2132';
        $xyBooks=$bookModel->getBooks($xybooks);

        //获得都市类的书籍
        $dsbooks='2099,2121,2122,2128';
        $dsBooks=$bookModel->getBooks($dsbooks);
        $dsOneBook=$bookModel->getOneBook(2131);

        //获得豪门类的数据
        $hmbooks='2126,2102,2096,2092';
        $hmBooks=$bookModel->getBooks($hmbooks);
        $hmOneBook=$bookModel->getOneBook(2120);

        //获得经典书籍的数据
        $gdBooks='2100,2101,2102';
        $gdBooks=$bookModel->getBooksImg($gdBooks);

        $newBooks=$bookModel->getNewBooks();

        $this->assign('recommendBook',$recommendBook);
        $this->assign('boyLikeReadBook',$boyLikeReadBook);
        $this->assign('girlLikeReadBook',$girlLikeReadBook);

        $this->assign('xiaoYuanOneBook',$xyOneBook);
        $this->assign('xiaoYuanBooks',$xyBooks);

        $this->assign('duShiOneBook',$dsOneBook);
        $this->assign('duShiBooks',$dsBooks);

        $this->assign('hmOneBook',$hmOneBook);
        $this->assign('hmBooks',$hmBooks);

        $this->assign('gdBooks',$gdBooks);

        $this->assign('newBooks',$newBooks);

        $this->display();
    }



}
