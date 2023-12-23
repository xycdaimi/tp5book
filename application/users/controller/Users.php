<?php
namespace app\users\controller;
use think\Controller;
use \app\index\model\Book;
use \app\index\model\Borrow;
use \app\index\model\OperationRecord;
use \app\index\model\BookType;
use \app\index\model\User;
use \app\index\controller\Base;
class Users extends Base
{
    public function users()
    {
        $user = session('user');
        $this->assign('name',$user['name']);
        $this->assign('borrow','borrow');
        $this->assign('home','userhome');
        $this->assign('book','userbook');
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
        $operationrecord = new OperationRecord;
        $data = $operationrecord->getOperationRecord(10);
        $book = new Book;
        $bookCount = $book->getCount();
        $over = new Borrow;
        $overCount = $over->getOverCount();
        $borrow = $over->getCount();
        $this->assign('data',$data);
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
        $book=$this->searchbook1($text,$type);
        $this->assign('data',$book['data']);
        $this->assign('p',$book['p']);
        $this->assign('groups',$groups);
        return $this->fetch('book');  
    }
}