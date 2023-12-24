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
        $this->assign('borrow','userborrow');
        $this->assign('home','userhome');
        $this->assign('book','userbook');
        $this->assign('back','userback');
        $this->assign('overtime','overtime');
        $this->assign('users','consumer');
        $this->assign('about','about');
        $this->assign('exit','exit');
        return $this->fetch();
    }
    public function home()
    {
        $book = new Book;
        $bookCount = $book->getCount();
        $over = new Borrow;
        $overCount = $over->getUserOverCount();
        $user = session('user');
        $data = $over->join('book','borrow.isbn = book.isbn')->where('username',$user['username'])->select();
        $this->assign('data',$data);
        $this->assign('book',$bookCount);
        $this->assign('over',$overCount);
        $this->assign('borrow',$user['had_count']);
        return $this->fetch();    
    }
    public function book()
    {
        $group = new BookType;
        $book = new Book;
        $data = $book->getBook(12);
        $p=input('page');
        if($p>0){
            $p=($p-1)*12;
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
        $book=$this->searchbook1(12,$text,$type);
        $this->assign('data',$book['data']);
        $this->assign('p',$book['p']);
        $this->assign('groups',$groups);
        return $this->fetch('book');  
    }
    public function borrow(){
        $user = session('user');
        $this->assign('user',$user);
        return $this->fetch();
    }
    public function back(){
        $borrow = new Borrow;
        $data = $borrow->getUserBorrow(12);
        $p=input('page');
        if($p>0){
            $p=($p-1)*12;
        }
        $this->assign('data',$data);
        $this->assign('p',$p);
        return $this->fetch();
    }
    public function searchborrow(){
        $text = input('search-text');
        $book=$this->searchborrow2($text);
        $this->assign('data',$book['data']);
        $this->assign('p',$book['p']);
        return $this->fetch('back');  
    }
    public function consumer(){
        $user = new User;
        $data = session('user');
        $this->assign('user',$data);
        return $this->fetch();
    }
}