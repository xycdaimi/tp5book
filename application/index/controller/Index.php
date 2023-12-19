<?php
namespace app\index\controller;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        $this->assign('start','login');
        return $this->fetch();
    }
    public function login()
    {
        if(session('?user')){
            $user = session('user');
            if($user['groups']=='admin'){
                $this->redirect('admin/admin/admin');
            }
            else if($user['groups']=='user'){
                $this->redirect('user/user/user');
            }
        }
        return $this->fetch();
    }
    function register(){
        return $this->fetch();
    }
}
