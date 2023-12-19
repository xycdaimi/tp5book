<?php
namespace app\index\controller;
use think\Controller;
use \app\index\model\User;
class Login extends Controller
{
    public function index()
    {
        $username = input('post.username');
        $password = md5(input('post.password'));
        $user=User::all(['username'=>$username,'password'=>$password]);
        $resultCode = count($user);
        if($resultCode==1){
            session('user',$user[0]);
            if($user[0]['groups']=='admin'){
                $resultCode = 2;
            }
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
    function repassword(){
        $name= input('post.password-name');
        $idCard = input('post.password-id-card');
        $phone = input('post.password-phone');
        $newPassword = md5(input('post.password-password'));
        $user=User::all(['name'=>$name,'id_card'=>$idCard,'phone'=>$phone]);
        $resultCode = count($user);
        if($resultCode==1){
            $user[0]->password=$newPassword;
            $user[0]->save();
        }
        $reuser = session('user');
        $reuser['password']=$newPassword;
        session('user',$reuser);
        return json_encode(['resultCode'=>$resultCode]);
    }
}
