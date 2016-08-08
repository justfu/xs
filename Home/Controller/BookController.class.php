<?php
namespace Home\Controller;
use Model\BookListModel;
use Model\BookModel;
use Think\Controller;
use Think\Log;
class BookController extends Controller{
    public function detail($bookId){

        //取得当前bookid值的书籍详情
        $bookModel=new \Model\BookModel();
        $detail=$bookModel->getBookDetail($bookId);

        //取得当前书籍的阅读量
        $rCountModel=new \Model\ReadCountModel();
        $rcount=$rCountModel->getReadCount($bookId);

        $detail=$detail[0];
        $detail['rcount']=$rcount;

        //取得当前书籍的最新篇章
        $listModel=new \Model\BookListModel();
        $newChapter=$listModel->getMostNewChapter($bookId);
        $newChapter=$newChapter[0];

        //获得当前书籍最后章节更新时间
        $difference=getTimeDifference($newChapter['addtime']);
        $newChapter['addtime']=$difference;

        //获得当前书籍六章数据
        $chapterTitleAsc=$listModel->getSixChapter($bookId,0);
        $chapterTitleDesc=$listModel->getSixChapter($bookId,1);

        //获得当前书籍的章节数量信息
        $chapterCount=$listModel->getChapterCount($bookId);
        $chapterCount=$chapterCount[0]['count(*)'];


        //分配标签
        $this->assign('detail',$detail);
        $this->assign('newChapter',$newChapter);
        $this->assign('chapterTitleAsc',$chapterTitleAsc);
        $this->assign('chapterTitleDesc',$chapterTitleDesc);
        $this->assign('chapterCount',$chapterCount);
        $this->display();
    }

    public function getRadomBook(){
        $bookType=addslashes($_POST['bookType']);
        if($bookType){
           $bookModel=new \Model\BookModel();
           $res=$bookModel->getBookRadom($bookType);
           $this->ajaxReturn($res);
        }else{
            Log::write('ajax请求数据失败,错误原因:为传递post信息','WARN');
        }
    }

    public function chapter($bookId,$page=1){
         if($page<1){
            $page=1;
         }
         $bookListModel=new BookListModel();
         $bookListModel->getChapterList($bookId);
         $bookModel=new \Model\BookModel();
         $bookDetail=$bookModel->getBookDetail($bookId);
         $bookDetail=$bookDetail[0];
         $pageModel=new \Tools\Page('book_list',array('id','title'),"book_id=$bookId");
         $chapterData=$pageModel->returnPageData($page);
         $pageCount=$pageModel->getPageCounts();
         if($page>$pageCount){
             $this->assign('chapterData',"");
         }else{
             $this->assign('chapterData',$chapterData);
         }
         $allCounts=$pageModel->getAllCounts();
         $this->assign('bookDetail',$bookDetail);
         $this->assign('nowpage',$page);
         $this->assign('bookId',$bookId);
         $this->assign('pageCount',$pageCount);
         $this->assign('allCounts',$allCounts);
         $this->display();
    }

    public function getChapterData(){
         $bookId=$_POST['bookId'];
         $chapterId=$_POST['chapterId'];
         $bookListModel=new \Model\BookListModel();
         $firstChapterId=$bookListModel->getFirstChapterIdByBookId($bookId)[0]['id'];
         $bookListModel->getChapterContent($bookId,$firstChapterId);
    }

    public function reading($bookId){

        //
        $bookModel=new \Model\BookModel();
        $detail=$bookModel->getBookDetail($bookId);
        $detail=$detail[0];
        $this->assign('detail',$detail);
        $this->assign('bookId',$bookId);
        $this->display();
    }
}