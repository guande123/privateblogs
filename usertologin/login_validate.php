<?php
  include_once '../lib/BmobObject.class.php';
  include_once '../lib/BmobUser.class.php';
  $email =$password = "";
  if($_SERVER["REQUEST_METHOD"]!="POST"){
	  //这里使用重定向。避免用户使用历史纪录添加用户
	 $chongdingxiang = "<script type='text/javascript' >window.location.assign('login.php');</script>";
	 echo $chongdingxiang;
  }else{
	  $email = $_POST['email'];
	  $password = $_POST['password'];
  }
  $bmobUser = new BmobUser();  
  $res  = $bmobUser->login($email,$password);
   if($res!=null){
	   echo  "";
   }else{
	   
   }
  ?>