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
        $book = Book::get(['isbn'=>$id]);
        $borrow = new Borrow;
        $borr = $borrow->where('isbn',$id)->select();
        $operationRecord = new OperationRecord;
        $op = $operationRecord->where('book_name',$book['name'])->select();
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
    
        if($resultCode){
            if($book->isUpdate(true)->save()!=1){
                $resultCode=0;
            }
        }
        foreach ($borr as $key => $value) {
            $value['name']=$book->name;
            $value->isUpdate(true)->save();
        }
        foreach ($op as $key => $value) {
            $value['book_name']=$book->name;
            $value['info']=mb_substr($value['info'],0,3).$book->name.'书籍';
            $value->isUpdate(true)->save();
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
    public function backborrow(){
        $id = input('post.id');
        $borrow = new Borrow;
        $operationRecord = new OperationRecord;
        $book = new Book;
        $user = new User;
        $yong = session('user');
        $res = $borrow->where('id',$id)->find();
        $data = $book->where('isbn',$res['isbn'])->find();
        $userborrow = $user->where('username',$res['username'])->find();
        $resultCode=-1;
        if($userborrow['had_count']==$userborrow['book_count']){
            $resultCode=-2;
            return json_encode(['resultCode'=>$resultCode]);
        }
        if($data['total']<=$data['quantity']){
            return json_encode(['resultCode'=>$resultCode]);
        }
        $data->quantity=$data->quantity+1;
        if($data->isUpdate(true)->save()){
            if($userborrow['Id']==$yong['Id']){
                $ci = $yong['had_count'];
                $yong['had_count']=$ci+1;
                session('user',$yong);
            }
            $userborrow->had_count=$userborrow['had_count']+1;
            $userborrow->isUpdate(true)->save();
            $res->delete();
            $operationRecord->data([
                'time'=>date("Y-m-d H:i:s"),
                'username'=>$userborrow['username'],
                'name'=>$userborrow['name'],
                'book_name'=>$data['name'],
                'info'=>'还回了'.$data['name'].'书籍'
            ]);
            $operationRecord->save();
            $resultCode=1;
        }else{
            $resultCode=0;
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
    public function borrowbook1(){
        $isbn = input('post.isbn');
        $bookname = input('post.bookname');
        $username = input('post.username');
        $idCard = input('post.id-card');
        $phone = input('post.phone');
        $resultCode=0;
        $book = new Book;
        $borrow = new Borrow;
        $user = new User;
        $yong = session('user');
        
        $count = $book->where('isbn',$isbn)->find();
        if($count->quantity){
            $res=$user->where(['username'=>$username,'id_card'=>$idCard,'phone'=>$phone])->select();
            if(count($res)==1){
                if(!$res[0]['had_count']){
                    $resultCode=-4;
                    return json_encode(['resultCode'=>$resultCode]);
                }
                $nowDate = date("Y-m-d H:i:s");
                $futureDate = date("Y-m-d H:i:s",strtotime("+1 month"));
                $borrow->data([
                    'name'=>$bookname,
                    'isbn'=>$isbn,
                    'username'=>$username,
                    'id_card'=>$idCard,
                    'phone'=>$phone,
                    'time'=>$nowDate,
                    'r_time'=>$futureDate
                ]);
                if($borrow->save()){
                    $operationRecord = new OperationRecord;
                    $operationRecord->data([
                        'time'=>date("Y-m-d H:i:s"),
                        'username'=>$res[0]['username'],
                        'name'=>$res[0]['name'],
                        'book_name'=>$count['name'],
                        'info'=>'借走了'.$count['name'].'书籍'
                    ]);
                    if($operationRecord->save()){
                        $count->quantity=$count->quantity-1;
                        if($count->isUpdate(true)->save()){
                            if($res[0]['Id']==$yong['Id']){
                                $ci = $yong['had_count'];
                                $yong['had_count']=$ci-1;
                                session('user',$yong);
                            }
                            $res[0]['had_count']=$res[0]['had_count']-1;
                            $res[0]->isUpdate(true)->save();
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
            else{
                $resultCode=-3;
            }
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
    public function borrowbook2(){
        $isbn = input('post.isbn');
        $bookname = input('post.bookname');

        
        $resultCode=0;
        $book = new Book;
        $borrow = new Borrow;
        $user = new User;
        $yong = session('user');
        $username = $yong['username'];
        $idCard = $yong['id_card'];
        $phone = $yong['phone'];

        $count = $book->where('isbn',$isbn)->find();
        if($count->quantity){
            $res=$user->where(['username'=>$username,'id_card'=>$idCard,'phone'=>$phone])->select();
            if(count($res)==1){
                if(!$res[0]['had_count']){
                    $resultCode=-4;
                    return json_encode(['resultCode'=>$resultCode]);
                }
                $nowDate = date("Y-m-d H:i:s");
                $futureDate = date("Y-m-d H:i:s",strtotime("+1 month"));
                $borrow->data([
                    'name'=>$bookname,
                    'isbn'=>$isbn,
                    'username'=>$username,
                    'id_card'=>$idCard,
                    'phone'=>$phone,
                    'time'=>$nowDate,
                    'r_time'=>$futureDate
                ]);
                if($borrow->save()){
                    $operationRecord = new OperationRecord;
                    $operationRecord->data([
                        'time'=>date("Y-m-d H:i:s"),
                        'username'=>$res[0]['username'],
                        'name'=>$res[0]['name'],
                        'book_name'=>$count['name'],
                        'info'=>'借走了'.$count['name'].'书籍'
                    ]);
                    if($operationRecord->save()){
                        $count->quantity=$count->quantity-1;
                        if($count->isUpdate(true)->save()){
                            $ci = $yong['had_count'];
                            $yong['had_count']=$ci-1;
                            session('user',$yong);
                            $res[0]['had_count']=$res[0]['had_count']-1;
                            $res[0]->isUpdate(true)->save();
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
            else{
                $resultCode=-3;
            }
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
    public function searchbook1($pg,$text,$type="isbn")
    {
        $book = new Book;
        if($text!=''){
        $book = $book->where(getSearchType($type),'like',"%$text%");
        }
        $data=$book->order('isbn')->paginate($pg,false,['query'=>['search-type'=>$type,'search-text'=>$text]]);
        $p=input('page');
        if($p>0){
            $p=($p-1)*$pg;
        }
        return [
            'data'=>$data,
            'p'=>$p
        ];  
    }
    public function searchbook2($text,$type="isbn"){
        $book = new Book;
        if($text!=''){
        $book = $book->where(getSearchType($type),'like',"%$text%");
        }
        $data=$book->order('isbn')->find();
        return json_encode($data);
    }
    public function searchborrow1($text){
        $borrow = new Borrow;
        if($text!=''){
            $borrow = $borrow->where('isbn','like',"%$text%");
        }
        $data = $borrow->order('isbn')->paginate(10,false,['query'=>['search-text'=>$text]]);
        $p=input('page');
        if($p>0){
            $p=($p-1)*10;
        }
        return [
            'data'=>$data,
            'p'=>$p
        ];  
    }
    public function searchborrow2($text){
        $borrow = new Borrow;
        if($text!=''){
            $borrow = $borrow->where('isbn','like',"%$text%");
        }
        $user = session('user');
        $data = $borrow->where('username',$user['username'])->order('isbn')->paginate(12,false,['query'=>['search-text'=>$text]]);
        $p=input('page');
        if($p>0){
            $p=($p-1)*12;
        }
        return [
            'data'=>$data,
            'p'=>$p
        ];  
    }
    public function over($text){
        $borrow = new Borrow;
        if($text!=''){
            $borrow = $borrow->where('isbn','like',"%$text%");
        }
        $date = date("Y-m-d H-i-s");
        $data = $borrow->where('r_time','<',$date)->order('isbn')->paginate(10,false,['query'=>['search-text'=>$text]]);
        $p=input('page');
        if($p>0){
            $p=($p-1)*10;
        }
        return [
            'data'=>$data,
            'p'=>$p
        ];  
    }
    public function searchusersguanli($text,$type)
    {
        $user = new User;
        if($text!=''){
        $user = $user->where(getSearchUsersType($type),'like',"%$text%");
        }
        $data=$user->where('groups','user')->order('id_card')->paginate(10,false,['query'=>['search-type'=>$type,'search-text'=>$text]]);
        $p=input('page');
        if($p>0){
            $p=($p-1)*10;
        }
        return [
            'data'=>$data,
            'p'=>$p
        ];  
    }
    public function deleteuser(){
        $id = input('post.id');
        $resultCode=0;
        $user = session('user');
        if(User::destroy(['Id'=>$id])==1){
            $resultCode=1;
        }
        if($user['Id']==$id){
            session(null);
            $resultCode=2;
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
    public function edituser(){
        $id = input('post.id');
        $username = input('post.edit-username');
        $password = input('post.edit-password');
        $name = input('post.edit-name');
        $gender = input('post.edit-gender');
        $idCard = input('post.edit-id-card');
        $phone = input('post.edit-phone');
        $identity = input('post.edit-identity');
        $user = User::get(['Id'=>$id]);
        $borrow = new Borrow;
        $borr = $borrow->where('username',$user['username'])->select();
        $operationRecord = new OperationRecord;
        $op = $operationRecord->where('username',$user['username'])->select();
        $xinxi = new User;
        $resultCode=1;
        if(!empty($username)){
            $data = $xinxi->where('username',$username)->count();
            if($data){
                $resultCode=-2;
                    return json_encode(['resultCode'=>$resultCode]);
            }
            $user->username=$username;
        }
        if(!empty($password)){
            $user->password=md5($password);
        }

        // 修改名字字段
        if(!empty($name)){
            $user->name=$name;
        }

        
        if(!empty($gender)){
            $user->gender=$gender;
        }

        
        if(!empty($idCard)){
            $data = $xinxi->where('id_card',$idCard)->count();
            if($data){
                $resultCode=-3;
                    return json_encode(['resultCode'=>$resultCode]);
            }
            $user->id_card=$idCard;
        }

        
        if(!empty($phone)){
            $data = $xinxi->where('phone',$phone)->count();
            if($data){
                $resultCode=-4;
                    return json_encode(['resultCode'=>$resultCode]);
            }
            $user->phone=$phone;
        }

        
        if(!empty($identity)){
            $iden=getUserIdentity($identity);
            $u = getUserIdentity($user->identity);
            if($iden=='老师'&&$u='学生'){
                $user->book_count=5;
                $user->had_count=$user->had_count+2;
            }
            else if($iden=='学生'&&$u='老师'){
                $user->book_count=3;
                if($user->had_count<2){
                    $resultCode=-1;
                    return json_encode(['resultCode'=>$resultCode]);
                }
                else{
                    $user->had_count=$user->had_count-2;
                }
            }
            $user->identity=$iden;
        }
        if($resultCode){
            if($user->isUpdate(true)->save()!=1){
                $resultCode=0;
            }
        }
        foreach ($borr as $key => $value) {
            $value['username']=$user->username;
            $value['id_card']=$user->id_card;
            $value['phone']=$user->phone;
            $value->isUpdate(true)->save();
        }
        foreach ($op as $key => $value) {
            $value['name']=$user->name;
            $value['username']=$user->username;
            $value->isUpdate(true)->save();
        }
        $u = session('user');
        if($u['Id']==$user->Id){
            session('user',$user);
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
    public function addbooktype(){
        $name = input('post.add-type-name');
        $type = new BookType;
        $booktype = $type->where('type_name',$name)->find();
        $resultCode=0;
        if(!$booktype){
            $type->type_name=$name;
            if($type->save()){
                $resultCode=1;
            }
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
    public function editbooktype(){
        $oldname = input('post.edit-old-type-name');
        $newname = input('post.edit-new-type-name');
        $resultCode=0;
        $type = new BookType;
        $book = new Book;
        $booktype = $type->where('type_name',$oldname)->find();
        if($booktype){
            $type->type_name=$newname;
            if($type->save()){
                $data = $book->where('groups',$oldname)->select();
                foreach ($data as $key => $value) {
                    $value['groups']=$newname;
                    $value->isUpdate(true)->save();
                }
                $booktype->delete();
                $resultCode=1;
            }
            else{
                $resultCode=-1;
            }
        }
        return json_encode(['resultCode'=>$resultCode]);
    }

    public function deletebooktype(){
        $name = input('post.delete-type-name');
        $resultCode=0;
        $book = new Book;
        $shu = $book->where('groups',$name)->count();
        if($shu){
            $resultCode=-1;
        }
        else{
            $type = new BookType;
            $booktype = $type->where('type_name',$name)->find();
            if($booktype){
                $booktype->delete();
                $resultCode=1;
            }
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
    public function editadminpassword(){
        $password= input('post.edit-admin-password');
        $resultCode=0;
        $user = new User;
        $admin = $user->where('Id','1')->find();
        $admin->password=md5($password);
        if($admin->isUpdate(true)->save()){
            $up = session('user');
            $up['password']=md5($password);
            session('user',$up);
            $resultCode=1;
        }
        return json_encode(['resultCode'=>$resultCode]);
    }
}