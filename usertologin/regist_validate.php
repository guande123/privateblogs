<?php
  include_once '../lib/BmobObject.class.php';
  include_once '../lib/BmobUser.class.php';
  //&nbsp;<span id="s_content">5</span><span>秒后自动跳转<a href="login.php">登陆界面</a>!!</span>
  $username =$password= $phoneNumber=$email = $secretKey = "";
  if($_SERVER["REQUEST_METHOD"]!="POST"){
  //这里使用重定向。避免用户使用历史纪录添加用户
	 $chongdingxiang = "<script type='text/javascript' >window.location.assign('regist.php');</script>";
     echo $chongdingxiang;
 }else{
try{
	$username = $_GET["username"];
	$password = $_GET["password"];
	$phoneNumber =$_GET["phonenumber"];
	$email = $_GET["email"];
	$secretKey = $_GET["secretKey"];
	$user2 = new BmobUser(); 
	if($secretKey=="987945799"){//超级用户注册
		 $user2->register(array(
			"username"=>$username,
			"password"=>$password,
			"mobilePhoneNumber"=>$phoneNumber,
			"email"=>$email ,
			"secretKey"=>true,
			"isManager"=>true));
	}else{
		$user2->register(array(
			"username"=>$username,
			"password"=>$password,
			"mobilePhoneNumber"=>$phoneNumber,
			"email"=>$email ,
			"secretKey"=>false,
			"isManager"=>false));
	}
	echo "OK";
   }catch( Exception $e ){
	  echo $e->getMessage();
 }

?>
