<?php
namespace app\index\controller;
use think\Controller;
use \app\index\model\User;
class Register extends Controller
{
    public function index()
    {
        $username = input('post.username');
        $password = input('post.password');
        $name = input('post.name');
        $gender = input('post.gender');
        $idCard = input('post.id-card');
        $phone = input('post.phone');
        $identity = input('post.identity');
        $code = input('post.code');
        if(!captcha_check($code)){
            $resultCode=-1;
            return json_encode(['resultCode'=>$resultCode]);
        }
        $user = User::all(function($query) use ($idCard,$phone,$username){$query->where('id_card',$idCard)->whereor('phone',$phone)->whereor('username',$username);});
        $resultCode = count($user);
        if($resultCode!=0){
            $id=0;
            $ph=0;
            $un=0;
            foreach ($user as $key => $value) {
                if($idCard == $value['id_card']&&$id==0){
                    $id++;
                }
                if($phone == $value['phone']&&$ph==0){
                    $ph++;
                }
                if($username == $value['username']&&$un==0){
                    $un++;
                }
                if($id&&$ph&&$un){
                    return json_encode(['resultCode'=>3]);
                }
            }
            if($id){
                return json_encode(['resultCode'=>1]);
            }
            else if ($ph) {
                return json_encode(['resultCode'=>2]);
            }
            else if($un){
                return json_encode(['resultCode'=>3]);
            }
        }
        $bookCount = 0;
        if($identity == 'student'){
            $bookCount = 3;
            $identity = "学生";
        }
        if($identity == 'teacher'){
            $bookCount = 5;
            $identity = "老师";
        }
        $user = new User;
        $user->Id=uuid();
        $user->groups = 'user';
        $user->name=$name;
        $user->username=$username;
        $user->password=md5($password);
        $user->gender=$gender;
        $user->id_card=$idCard;
        $user->phone=$phone;
        $user->identity=$identity;
        $user->book_count=$bookCount;
        $user->had_count=$bookCount;
        $user->save();
        $data = $user->where('username',$username)->find();
        if(input('post.request')!='add')
            session('user',$data);
        return json_encode(['resultCode'=>$resultCode]);
    }
}
