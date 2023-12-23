<?php
//Base
think\Route::rule('addBook','index/base/addbook');
think\Route::rule('editBook','index/base/editbook');
think\Route::rule('deleteBook','index/base/deletebook');
think\Route::rule('borrowBook','index/base/borrowbook1');
think\Route::rule("search",'index/base/searchbook2');
think\Route::rule("backBook",'index/base/backborrow');
think\Route::rule("deleteUser",'index/base/deleteuser');
think\Route::rule("editUser",'index/base/edituser');
think\Route::rule("addBookType",'index/base/addbooktype');
think\Route::rule("deleteBookType",'index/base/deletebooktype');
think\Route::rule("editAdminPassword",'index/base/editadminpassword');

//Admin
think\Route::rule("searchBorrow",'admin/admin/searchborrow');
think\Route::rule('searchBook','admin/admin/searchbook');
think\Route::rule('searchOver','admin/admin/searchover');
think\Route::rule('searchUsers','admin/admin/searchusers');


//admin页面
think\Route::rule('admin','admin/admin/admin');
think\Route::rule('exit','admin/admin/exitBack');
think\Route::rule('home','admin/admin/home');
think\Route::rule('book','admin/admin/book');
think\Route::rule('borrow','admin/admin/borrow');
think\Route::rule('back','admin/admin/back');
think\Route::rule('overtime','admin/admin/overtime');
think\Route::rule('users','admin/admin/users');
think\Route::rule('about','admin/admin/about');
think\Route::rule('system','admin/admin/system');

//User
think\Route::rule('user','users/users/users');
think\Route::rule('userhome','users/users/home');
think\Route::rule('userbook','users/users/book');


//index
think\Route::rule('login','index/index/login');
think\Route::rule('register','index/index/register');
?>