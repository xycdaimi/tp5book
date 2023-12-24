<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Borrow extends Model
{
    protected $table ='borrow';
    function getOverCount(){
        $date = date("Y-m-d H-i-s");
        return $this->where('r_time','<',$date)->count();
    }
    function getCount(){
        return $this->count();
    }
    function getBorrow($page){
        return $this->order('isbn')->paginate($page);
    }
    function getUserBorrow($page){
        $user = session('user');
        return $this->where('username',$user['username'])->order('isbn')->paginate($page);
    }
    function getOver($page){
        $date = date("Y-m-d H-i-s");
        return $this->order('isbn')->where('r_time','<',$date)->paginate($page);
    }
    function getUserOverCount(){
        $date = date("Y-m-d H-i-s");
        $user = session('user');
        return $this->where('username',$user['username'])->where('r_time','<',$date)->count();
    }
}