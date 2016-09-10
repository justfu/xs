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
            Log::write('ajax请求数据失败,错误原因:未传递post信息','WARN');
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
         $bookId=I('post.bookId');
         $ChapterId=I('post.chapterId');
         $bookListModel=new \Model\BookListModel();
        if(empty($ChapterId)) {
            $firstChapterId = $bookListModel->getFirstChapterIdByBookId($bookId)[0]['id'];
            $res = $bookListModel->getChapterContent($bookId, $firstChapterId);
//            $nextChapterId = $res[0]['id'] + 1;
        }else{
            $res = $bookListModel->getChapterContent($bookId, $ChapterId);
        }
        $nowChapterId=$res[0]['id'];
        if ($bookListModel->checkChapterExist($nowChapterId+1)) {
            $res[0]['nextChapterId'] = $res[0]['id']+1;
        } else {
            $res[0]['content'] = '小说已经撸完!!!';
        }
        if ($bookListModel->checkChapterExist($nowChapterId-1)) {
            $res[0]['preChapterId'] = $res[0]['id']-1;
        } else {
            $res[0]['preChapterId'] = 0;
        }
         echo json_encode($res[0]);
    }

    public function reading($bookId){
        $chapterId=I('get.chapterId');
        $bookModel=new \Model\BookModel();
        $detail=$bookModel->getBookDetail($bookId);
        $detail=$detail[0];
        $this->assign('chapterId',$chapterId);
        $this->assign('detail',$detail);
        $this->assign('bookId',$bookId);
        $this->display();
    }

    public function search(){
        if(I('get.keywords')){
            $keywords=I('get.keywords');
        }
        $this->assign('keywords',$keywords);
        $this->display();
    }

    public function searchShow(){
        $arr0=unserialize(S('key0'));
        $arr1=unserialize(S('key1'));
        $arr2=unserialize(S('key2'));
        $arr3=unserialize(S('key3'));
        $arr4=unserialize(S('key4'));
        if(empty($arr4)){
             $bookModel=new BookModel();
             $arr=$bookModel->getNewBooks2();
        }else {
            $arr = array();
            for ($i = 0; $i < 5; $i++) {
                $name = 'arr' . $i;
                $arr[] = $$name;
            }
        }
        $this->assign('hotSearch',$arr);
        $this->display();
    }

    public function ajaxSearch(){
        if(IS_GET){
            $data = array();
            $data['data'] = array();
            $data['status'] = 200;
            $data['msg'] = 'ok';
            try{
                $keywords=I('get.keywords');
                $page=I('get.pageNum');
                $field=I('get.field');
                $pageCount=I('get.pageCount');
                if(empty($keywords)){
                    my_log('前台传输验证信息为空!!');
                    E('前台传输验证信息为空!!',403);
                }

                    $bookModel=new BookModel();
                    $res=$bookModel->getSeachData($keywords,$page,$pageCount);
                    $bookListMode=new BookListModel();

                    for($i=0;$i<count($res);$i++){
                        if(empty(S("key{$i}"))) {
                            $array = array();
                            $array['book_id'] = $res[$i]['id'];
                            $array['book_name'] = $res[$i]['book_name'];
                            $array['book_author'] = $res[$i]['book_author'];
                            $str = serialize($array);
                            S('key' . $i, $str, 600);
                        }
                        $res[$i]['book_desc']=str_replace('<p>','',$res[$i]['book_desc']);
                        $res[$i]['book_desc']=str_replace('</p>','',$res[$i]['book_desc']);
                        if($res[$i]['is_over']==1) {
                            $res[$i]['lastChapterTitle'] = $bookListMode->getLastChapter($res[$i]['id'])['title'];
                        }
                    }
//                    if(!$res){
//                        my_log('模糊查询失败');
//                        E('模糊查询失败',403);
//                    }
                    if(count($res)>0) {
                        $data['ajaxResult']=2;
                        $data['data']=json_encode($res);
                    }else{
                        $data['status1']=-1;
//                        $data['data']['data']=null;
                    }

            }catch(\Exception $e){
//                $data['status'] = $e->getCode();
                $data['msg'] = $e->getMessage();
            }
//            echo $_GET['callback'].'('.json_encode($data).')';
            $this->ajaxReturn($data);
        }
    }

    public function hotSearch(){
        $arr0=unserialize(S('key0'));
        $arr1=unserialize(S('key1'));
        $arr2=unserialize(S('key2'));
        $arr3=unserialize(S('key3'));
        $arr4=unserialize(S('key4'));
        $arr=array();
        for($i=0;$i<5;$i++){
            $name='arr'.$i;
            $arr[]=$$name;
        }
        $this->assign('hotSearch',$arr);
    }

    public function category(){
        $this->display();
    }

    public function category2(){
        $bookType=I('get.bookType');
        $this->assign('bookType',$bookType);
        $this->display();
    }
    public function category3(){
        if(IS_GET){
            $data = array();
            $data['data'] = array();
            $data['status'] = 200;
            $data['msg'] = 'ok';
            try{
                $bookType=I('get.bookType');
                $page=I('get.pageNum');
                $type=I('get.type');
//                $field=I('get.field');
                $pageCount=I('get.pageSize');
                if(empty($bookType)){
                    my_log('前台传输验证信息为空!!');
                    E('前台传输验证信息为空!!',403);
                }

                $bookModel=new BookModel();
                $res=$bookModel->getCategoryData($bookType,$page,$pageCount,$type);
                $bookListMode=new BookListModel();
                for($i=0;$i<count($res);$i++){
                    $res[$i]['book_desc']=str_replace('<p>','',$res[$i]['book_desc']);
                    $res[$i]['book_desc']=str_replace('</p>','',$res[$i]['book_desc']);
                    if($res[$i]['is_over']==1) {
                        $res[$i]['lastChapterTitle'] = $bookListMode->getLastChapter($res[$i]['id'])['title'];
                    }
                }
                if(count($res)>0) {
                    $data['ajaxResult']=2;
                    $data['data']=json_encode($res);
                }else{
                    $data['status1']=-2;
//                        $data['data']['data']=null;
                }

            }catch(\Exception $e){
//                $data['status'] = $e->getCode();
                $data['msg'] = $e->getMessage();
            }
//            echo $_GET['callback'].'('.json_encode($data).')';
            $this->ajaxReturn($data);
        }

        $this->display();
    }

    public function saveReading(){
        $data = array();
        $data['data'] = array();
        $data['code'] = 200;
        $data['msg'] = 'ok';
        $bookId=I('post.bookId');
        $bookListModel=new BookListModel();
        $chapterId=I('post.chapterId')?I('post.chapterId'):$bookListModel->getFirstChapterIdByBookId($bookId)[0]['id'];
        $uid=session('user_id');
        if(empty($uid)){
            E('您未登录');
        }
        $collect=D('collect');
        $arr=array();
        $arr['uid']=$uid;
        $arr['book_id']=$bookId;
        $arr['chapter_id']=$chapterId;
        $arr['time']=time();
        $res=$collect->add($arr);
        if(!$res){
            $data['code'] = 300;
            $data['msg'] = '收藏失败';
        }
        $this->ajaxReturn($data);
    }

    public function getSaveReading(){
        $array=array();
        if(!empty($_COOKIE)){
            foreach($_COOKIE as $k => $v){
                $arr=unserialize($v);
                $bookModel=new BookModel();
                if(!empty($arr['bookId'])){
                    $res=$bookModel->getBookDetail($arr['bookId'])[0];
                }
                $bookListModel=new BookListModel();
                if($arr['chapterId']==0){
                    $id=$bookListModel->getFirstChapterIdByBookId($arr['bookId'])[0]['id'];
                    $res['chapterName']=$bookListModel->getChapterContent($arr['bookId'],$id);
                }else{
                    $res['chapterName']=$bookListModel->getChapterContent($arr['bookId'],$arr['chapterId']);
                }
                $array[]=$res;
            }
           $this->ajaxReturn($array);
        }else{
           $array['data']=-1;
            $this->ajaxReturn($array);
        }
    }


    //获得收藏的书籍
    public function getSaveBookByDb(){
        $nowpage=I('post.page');
        $data = array();
        $data['data'] = array();
        $data['code'] = 200;
        $data['msg'] = 'ok';
        $uid=session('user_id');
        if(empty($uid)){
            $data['code']=401;//未登录或者访问超时
            $data['msg']='timeout!!!';
            $this->ajaxReturn($data);
        }
        $bookModel=new BookModel();
        $res=$bookModel->getCollectData($nowpage,5,$uid);
        $bookListModel=new BookListModel();
        $bookModel=new BookModel();
        for($i=0;$i<count($res);$i++){
            $bookDetail=$bookModel->getBookDetail($res[$i]['book_id']);
            $res[$i]['author']=$bookDetail[0]['book_author'];
            $res[$i]['book_name']=$bookDetail[0]['book_name'];
            $res[$i]['book_img']=$bookDetail[0]['book_img'];
            $res[$i]['time']=date('Y-m-d H:i:s',$res[$i]['time']);
            $res[$i]['new_chapter']=$bookListModel->getMostNewChapter($res[$i]['book_id'])[0]['title'];
            if($res[$i]['chapter_id']==0){
                $res[$i]['chapter_id']=$bookListModel->getFirstChapterIdByBookId($res[$i]['book_id'])[0]['id'];
            }
            $res[$i]['title']=$bookListModel->getChapterInfo($res[$i]['chapter_id'])['title'];
        }
        $this->ajaxReturn($res);
    }

    public function delSaveBookByDb(){
        $data = array();
        $data['data'] = array();
        $data['code'] = 200;
        $data['msg'] = 'ok';
        $cid=I('post.cid');
        if(empty($cid)){
            E('参数未传递!');
            my_log('删除收藏书籍时候出错!!!!');
        }
        $collectModel=D('collect');
        if(!$collectModel->delete($cid)){
            $data['code'] = 404;
            $data['msg']  = '删除出错';
        }
        $this->ajaxReturn($data);
    }
    public function bookShelf(){
        $this->display();
    }

    public function rank(){
        $bookModel=new \Model\BookModel();
        $collect=$bookModel->getMostCollectBooks();

        $maxLen=$bookModel->getMostLengthBooks(1);

        $minLen=$bookModel->getMostLengthBooks(0);

        $mostNew=$bookModel->getMostUpdateBooks();

        $this->assign('collect',$collect);
        $this->assign('maxLen',$maxLen);
        $this->assign('minLen',$minLen);
        $this->assign('mostNew',$mostNew);
        $this->display();
    }
}