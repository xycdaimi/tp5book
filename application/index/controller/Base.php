<?php
namespace app\index\controller;
use think\Controller;
use \app\index\model\User;
use \app\index\model\Book;
use \app\index\model\Borrow;
use \app\index\model\OperationRecord;
use \app\index\model\BookType;
class Base extends Controller
{
    public function addbook(){
        $group = input('post.add-group');
        $name = input('post.add-name');
        $author = input('post.add-author');
        $press = input('post.add-press');
        $price = input('post.add-price');
        $count = input('post.add-count');
        $isbn = input('post.add-isbn');
        $book = new Book;
        $is = $book->field('isbn')->where('isbn',$isbn)->find();
        $resultCode=0;
        if($is!=$isbn){
            $book->groups=$group;
            $book->name=$name;
            $book->author=$author;
            $book->press=$press;
            $book->price=$price;
            $book->quantity=$count;
            $book->total=$count;
            $book->isbn=$isbn;
            if($book->save()==1){
                $resultCode=1;
            }
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
    public function editbook(){
        $id = input('post.id');
        $group = input('post.edit-group');
        $name = input('post.edit-name');
        $author = input('post.edit-author');
        $press = input('post.edit-press');
        $price = input('post.edit-price');
        $count = input('post.edit-count');
        $isbn = input('post.edit-isbn');
        $book = Book::get(['isbn'=>$id]);
        $resultCode=1;
        // 修改组别字段
        if(!empty($group)){
            $book->groups=$group;
        }

        // 修改名字字段
        if(!empty($name)){
            $book->name=$name;
        }

        // 修改借书卡字段
        if(!empty($author)){
            $book->author=$author;
        }

        // 修改出版社字段
        if(!empty($press)){
            $book->press=$press;
        }

        // 修改价格字段
        if(!empty($price)){
            $book->price=$price;
        }

        // 修改图书数量字段
        if(!empty($count)){
            $num=$book->total - $book->quantity;
            if($count>=0){
                $book->quantity=$count;
                $book->total=$count+$num;
            }else{$resultCode=0;}
        }
    
        // 修改图书编号
        if(!empty($isbn)){
            $re = Book::get(['isbn'=>$isbn]);
            if(count($re)){
                $resultCode=0;
            }else{
                $book->isbn=$isbn;
            }
        }
        if($resultCode){
            if($book->save()!=1){
                $resultCode=0;
            }
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
    public function deletebook(){
        $id = input('post.id');
        $resultCode=0;
        if(Book::destroy(['isbn'=>$id])==1){
            $resultCode=1;
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
    public function borrowbook1(){
        $isbn = input('post.isbn');
        $name = input('post.name');
        $username = input('post.username');
        $idCard = input('post.id-card');
        $phone = input('post.phone');
        $resultCode=0;
        $book = new Book;
        $borrow = new Borrow;
        $user = new User;
        $count = $book->where('isbn',$isbn)->find();
        if($count->quantity){
            $res=$user->where(['username'=>$username,'id_card'=>$idCard,'phone'=>$phone])->select();
            if(count($res)==1){
                $nowDate = date("Y-m-d H:i:s");
                $futureDate = date("Y-m-d H:i:s",strtotime("+1 month"));
                $borrow->data([
                    'name'=>$name,
                    'isbn'=>$isbn,
                    'username'=>$username,
                    'id_card'=>$idCard,
                    'phone'=>$phone,
                    'time'=>$nowDate,
                    'r_time'=>$futureDate
                ]);
                if($borrow->save()){
                    $user = session('user');
                    $operationRecord = new OperationRecord;
                    $operationRecord->data([
                        'time'=>date("Y-m-d H:i:s"),
                        'name'=>$user['name'],
                        'book_name'=>$res['name'],
                        'info'=>'借走了'.$res['name'].'书籍'
                    ]);
                    if($operationRecord->save()){
                        $count->quantity=$count->quantity-1;
                        if($count->save()){
                            $resultCode=1;
                        }
                    }
                    else{
                        $resultCode=-2;
                    }
                }
                else
                {
                    $resultCode=-1;
                }
            }
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
    public function search1($text,$type="isbn")
    {
        $book = new Book;
        if($text!=''){
        $book = $book->where(getSearchType($type),'like',"%$text%");
        }
        $data=$book->order('isbn')->paginate(10,false,['query'=>['search-type'=>$type,'search-text'=>$text]]);
        $p=input('page');
        if($p>0){
            $p=($p-1)*10;
        }
        return [
            'data'=>$data,
            'p'=>$p
        ];  
    }
    public function search2($text,$type="isbn"){
        $book = new Book;
        if($text!=''){
        $book = $book->where(getSearchType($type),'like',"%$text%");
        }
        $data=$book->order('isbn')->find();
        return $data;
    }
}