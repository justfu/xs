<?php
namespace Model;
use Think\Model;

class UserModel extends Model{
    public function checkUser($username,$password){
         $userModel=D('user2');
         $username=addslashes($username);
         $res=$userModel->where("username='$username'")->limit(1)->find();
         if(count($res)==0){
             return 0;//未查询到用户名
         }
         if($res['password']!==md5($password)){
             return 1;//密码不正确
         }else{
             return $res;
         }
    }

    public function getPersonInfoByUid($uid){
        $userModel=D('user2');
        $res=$userModel->where("id=$uid")->find();
        return $res?$res:false;
    }

    public function checkUserExit($username){
        $userModel=D('user2');
        $res=$userModel->where("username='$username'")->find();
        return empty($res)?false:true;
    }

    public function getIdByName($username){
        $userModel=D('user2');
        return $userModel->where("username='$username'")->find()['id'];
    }
}
