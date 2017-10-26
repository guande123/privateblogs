<html>
    <?php  
		include_once '../lib/BmobObject.class.php';
		include_once '../lib/BmobUser.class.php';
		include_once '../lib/BmobSms.class.php';
	?>
   <head><title>user to login</title></head>
   <?php 
    
	 $bmobUser = new BmobUser();
     //获得当次session
     session_id(1001);
	 session_start();
	 $phoneNumber = "";
	 if(isset($_SESSION["phonenumber"])){
		 $phoneNumber =$_SESSION["phonenumber"];
	 }else{
		 echo "手机号码没有保存于session中";
	 }
	 
	 
      if($_SERVER["REQUEST_METHOD"]=="POST"){
		 $password =  $_POST["password"];
     	 $res = $bmobUser->resetPasswordBySmsCode($phoneNumber,$password ); // 使用短信验证码进行密码重置
			 
		 }
		}

	  }
   ?>
   <body>
       <form action="login.php" method="POST"> 
	      <h5>密码找回成功！</h5>
		  <p><input type="submit" value="点击返回" /></p>
	  </form>
   </body>
</html>