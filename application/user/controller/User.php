<?php
namespace app\user\controller;
use think\Controller;
class User extends Controller
{
    public function user()
    {
        $this->redirect('admin/admin/admin');
    }
}