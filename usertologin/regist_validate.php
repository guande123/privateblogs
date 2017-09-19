&nbsp;<span id="s_content">5</span><span>秒后自动跳转<a href="login.php">登陆界面</a>!!</span>
<?php
  include_once '../lib/BmobObject.class.php';
  include_once '../lib/BmobUser.class.php';
  $username =$password=$repassword = $phoneNumber=$email = "";
  if($_SERVER["REQUEST_METHOD"]!="POST"){
	  //这里使用重定向。避免用户使用历史纪录添加用户
	 $chongdingxiang = "<script type='text/javascript' >window.location.assign('regist.php');</script>";
	 echo $chongdingxiang;
  }else{
	$username = $_POST["username"];
	$password = $_POST["password"];
	$repassword = $_POST["repassword"];
	$phoneNumber = $_POST["phonenumber"];
	$email = $_POST["email"];
  }
 //$user = new BmobObject("user");//参数为表名
 // $user->create(array("username"=>$username,"password"=>$password,"phonenumber"=>$phoneNumber));//数组中的每一项为一个表字段
  $user2 = new BmobUser(); 
  $user2->register(array(
  "username"=>$username,
  "password"=>$password,
  "mobilePhoneNumber"=>$phoneNumber,
  "email"=>$email ));
  
  echo "<script type='text/javascript'>";
  echo "
      var timer = setInterval('tianzhuan()',1000);
	  var s = 5;
	  var content = document.getElementById('s_content');
	  alert(content);
      function tianzhuan(){
		if(s == 0){
			clearInterval(timer);
		}
		content.innerHTML = s;
		s--;
	  }
	    setTimeout(function(){
			window.location.assign('login.php');
		},5500);	
	  " ;
	
  echo "</script>";
?>
