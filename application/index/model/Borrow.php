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
}