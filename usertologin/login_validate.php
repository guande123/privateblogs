<?php
  include_once '../lib/BmobObject.class.php';
  include_once '../lib/BmobUser.class.php';
  $email =$password = "";
  if($_SERVER["REQUEST_METHOD"]!="POST"){
	  //这里使用重定向。避免用户使用历史纪录添加用户
	 $chongdingxiang = "<script type='text/javascript' >window.location.assign('login.php');</script>";
	 echo $chongdingxiang;
  }else{
	  $email = $_GET['email'];
	  $password = $_GET['password'];
  }
  session_start();
  try{
  $bmobUser = new BmobUser();  
  $res  = $bmobUser->login($email,$password);//登陆失败fatal error
  $_SESSION['res'] = $res;
   $_SESSION['password'] = $password;
   if($res->isManager){
	   echo "true";
	   echo "~".$res->username;
   }else{
	   echo "false";
	   echo "~".$res->username;
   }

  //header("location:../blogsarea/myblogs.php");  
 // var_dump($res);//object(stdClass)#3 (7) { ["createdAt"]=> string(19) "2017-09-18 18:20:29"
  // ["email"]=> string(16) "987945799@qq.com" ["mobilePhoneNumber"]=> string(11)
  // "13760790960" ["objectId"]=> string(10) "0e32416a28" 
  //["sessionToken"]=> string(32) "9c72a73c40d22298804d9c4753d7b965" 
  //["updatedAt"]=> string(19) "2017-09-18 18:20:29" ["username"]=> string(6) "gordon" }
  //echo $res->objectId;
  //登录成功进入主界面，失败跳转回登录界面   header("location:main.php");  
  //  $_SESSION["objectId"]=$res->objectId;
  // $chongdingxiang = "<script type='text/javascript' >window.location.assign('../blogsarea/myblogs.php');</script>";
  //echo   $chongdingxiang ;
  }catch(Exception $e){
	  echo $e->getMessage();
 }


  ?>