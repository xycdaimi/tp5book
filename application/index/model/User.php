<?php
namespace app\index\model;
use think\Model;
use think\Db;
class User extends Model
{
    protected $table ='user';
    function getUser($page){
        return $this->where('groups','user')->paginate($page);
    }
}