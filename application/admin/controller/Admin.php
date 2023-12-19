<?php
namespace app\admin\controller;
use think\Controller;
use \app\index\model\Book;
use \app\index\model\Borrow;
use \app\index\model\OperationRecord;
use \app\index\model\BookType;
use \app\index\model\User;
use \app\index\controller\Base;
class Admin extends Base
{
    public function admin()
    {
        $user = session('user');
        $this->assign('name',$user['name']);
        $this->assign('borrow','borrow');
        $this->assign('home','home');
        $this->assign('book','book');
        $this->assign('back','back');
        $this->assign('overtime','overtime');
        $this->assign('users','users');
        $this->assign('about','about');
        $this->assign('system','system');
        $this->assign('exit','exit');
        return $this->fetch();
    }
    public function home()
    {
        $book = new Book;
        $bookCount = $book->getCount();
        $over = new Borrow;
        $overCount = $over->getOverCount();
        $borrow = $over->getCount();
        $this->assign('book',$bookCount);
        $this->assign('over',$overCount);
        $this->assign('borrow',$borrow);
        return $this->fetch();    
    }
    public function book()
    {
        $group = new BookType;
        $book = new Book;
        $data = $book->getBook(10);
        $p=input('page');
        if($p>0){
            $p=($p-1)*10;
        }
        $groups = $group->getGroups();
        $this->assign('data',$data);
        $this->assign('p',$p);
        $this->assign('groups',$groups);
        return $this->fetch();    
    }
    public function searchbook(){
        $type = input('search-type');
        $text = input('search-text');
        $group = new BookType;
        $groups = $group->getGroups();
        $book=$this->search1($text,$type);
        $this->assign('data',$book['data']);
        $this->assign('p',$book['p']);
        $this->assign('groups',$groups);
        return $this->fetch('book');  
    }
    public function borrow(){
        return $this->fetch();
    }
    public function back(){
        return $this->fetch();
    }
    public function overtime(){
        return $this->fetch();
    }
    public function users(){
        return $this->fetch();
    }
    public function about()
    {
        return $this->fetch();
    }
    public function system()
    {
        return $this->fetch();
    }
    public function exitBack(){
        if(session('?user')){
            session(null);
        }
        $this->redirect('../../index');
    }
}