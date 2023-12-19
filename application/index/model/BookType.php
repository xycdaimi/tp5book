<?php
namespace app\index\model;
use think\Model;
use think\Db;
class BookType extends Model
{
    protected $table ='book_type';
    function getGroups(){
        return $this->select();
    }
}