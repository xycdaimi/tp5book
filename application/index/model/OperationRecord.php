<?php
namespace app\index\model;
use think\Model;
use think\Db;
class OperationRecord extends Model
{
    protected $table ='operation_record';
    function getOperationRecord($page){
        return $this->order('time desc')->paginate($page);
    }
}