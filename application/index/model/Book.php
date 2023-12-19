<?php
namespace app\index\model;
use think\Model;
use think\Db;
class Book extends Model
{
    protected $table ='book';
    function getCount(){
        return $this->sum('total');
    }
    function getBook($page){
        return $this->order('isbn')->paginate($page);
    }
}