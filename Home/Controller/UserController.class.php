<?php
namespace Home\Controller;
use Model\UserModel;
use Think\Controller;
use Model\UserModel as User;
use Tools\Logo;
class UserController extends Controller{
    public function login(){
        $arr=array();
        $arr['code']=200;
        $arr['msg']='ok';
        $arr['data']=array();
        $username=I('post.username');
        $password=I('post.password');
        $user=new User();
        $res=$user->checkUser($username,$password);
        if($res==0){
            $arr['code']=300;
            $this->ajaxReturn($arr);
        }elseif($res==1){
            $arr['code']=400;
            $this->ajaxReturn($arr);
        }
        session('user_id',$res['id'],3600);
        session('username',$res['username'],3600);
        $arr['data']['username']=$res['username'];
        $this->ajaxReturn($arr);
    }

    public function logout(){
        $arr=array();
        $arr['code']=200;
        $arr['msg']='ok';
        $arr['data']=array();
        if(session_destroy()){
            $this->ajaxReturn($arr);
        }else{
            $arr['code']=300;
            $this->ajaxReturn($arr);
        }
        //这里待解决问题
    }

    public function checkIsLogin(){
        $arr=array();
        $arr['code']=200;
        $arr['msg']='ok';
        $arr['data']=array();
        $username=session('username');
        if(empty($username)){
            $arr['code']=300;
            $arr['msg']='not login';
        }
        $this->ajaxReturn($arr);
    }

    public function pageLogin(){
        $l=I('get.l');
        $bookId=I('get.bookId');
        if(!empty($a)){
            $this->assign('type',$l);
            $this->assign('bookId',$bookId);
        }
        $this->display();
    }

    public function loginAction(){
        $username=I('post.tel');
        $password=I('post.password');
        $l=I('get.l');
        $bookId=I('get.bookId');

        //暂时不使用验证码
        //$checkcode=I('post.checkcode');
        $userModel=new \Model\UserModel();
        $res=$userModel->checkUser($username,$password);
        if($res==0){
            $this->error('用户名错误');
        }elseif($res==1){
            $this->error('密码填写错误');
        }else{
            session('user_id',$res['id'],3600);
            session('username',$res['username'],3600);
            if(!empty($l)){
                $this->redirect(__MODULE__.'/Book/detail',array('bookId'=>$bookId),2,'<h1>登录成功!<h1></h1>');
            }
            $this->redirect('person','',0,'正在跳转到个人中心!');
        }
    }

    public function test(){
        header("Content-type:image/png");
        $logo=new Logo();
        $logo->getImage('罗宏');
    }


    //获得用户头像
    public function getUserLogo(){
        $arr=array();
        $arr['code']=200;
        $arr['msg']='ok';
        $arr['data']=array();
        $username=I('post.username');
        $userModel=D('user2');
        $res=$userModel->field('logo,username')->where("username='{$username}'")->find();
        if(!empty($res)) {
            if (empty($res['logo'])) {
                //返回用户名
                $arr['data']['data'] = $username;
            } else {
                $arr['code'] = 201;//返回图像文件
                $arr['data']['data'] = $res['logo'];
            }
        }else{
            $arr['code'] = 404;
        }
        $this->ajaxReturn($arr);
    }

    public function person(){
        $username=session('username');
        $uid=session('user_id');
        if(empty($username)){
            $this->error('您未登录,请登录后访问','pageLogin.html');
        }
        $userModel=new \Model\UserModel();
        $personInfo=$userModel->getPersonInfoByUid($uid);
        $this->assign('username',$personInfo['username']);
        $this->assign('addtime',date('Y-m-d H:i:s',$personInfo['addtime']));
        $this->assign('email',$personInfo['email']);
        $this->assign('tel',$personInfo['tel']);
        $this->assign('logo',$personInfo['logo']);
        $this->display();
    }

    public function logOutAction(){
        session_destroy();
        $this->redirect('Index/index','',0);
    }

    public function register(){
        $this->display();
    }

    public function registerAction(){
         $username=I('post.username');
         $email=I('post.email');
         $tel=I('post.tel');
         $password=I('post.password');
         $password1=I('post.password1');
         if(empty($username)&&empty($email)&&empty($tel)&&empty($password)&&empty($password1)){
             $this->error('有参数为空!');
         }
         if($password!==$password1){
             $this->error('两次密码输入不一致!');
         }
         $userModel=new UserModel();
         if($userModel->checkUserExit($username)){
             $this->error('您的用户名太大众化了,已经存在了啊');
         }
         $userModel2=D('user2');
         $arr=array(
             'username' => $username,
             'email'    => $email,
             'tel'      => $tel,
             'password' => md5($password),
         );
         if($userModel2->add($arr)){
             $this->redirect(U(Index/index),'',2,'注册成功!');
         }else{
             $this->error('注册失败!');
         }
    }
}
