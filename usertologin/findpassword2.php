<html>
    <?php  
		include_once '../lib/BmobObject.class.php';
		include_once '../lib/BmobUser.class.php';
		include_once '../lib/BmobSms.class.php';
	?>
   <head><title>user to login</title></head>
   <?php 
    
	 $bmobUser = new BmobUser();
	 $bmobSms = new BmobSms();
      if($_SERVER["REQUEST_METHOD"]=="POST"){
		 $email =  $_POST["email"];
	     $res = $bmobUser->get();
		 
		for($i=0;$i<count($res->results);$i++){
			 if($email==$res->results[$i]->email){
				 $phoneNumber = $res->results[$i]->mobilePhoneNumber;
                 $bmobSms->sendSmsVerifyCode($phoneNumber,true);	//发送短信获取验证码			 
  
     //获得当次session
     session_id(1001);
	 session_start();
	 $SESSION['phonenumber'] = $phoneNumber;
	 

//				$res = $bmobUser->resetPasswordBySmsCode("111111", "134554"); // 使用短信验证码进行密码重置
			 
			 }
		}

	  }
   ?>
   <body>
       <form action="findpassword3.php" method="POST"> 
	      <h5>密码找回2！</h5>
		  <p class="u_para">  
		       <span class="u_label">输入验证码：</span>
		       <input id="email" type="text" name="verifycode"  />
			   <span id="email_tips"></span>
	      </p>
		  <p>
		   <span class="u_label">输入新密码：</span>
		       <input id="password" type="text" name="password"  />
			   <span id="password_tips"></span>
		  </p>	
		  <p><input type="submit" value="确认修改" /></p>
	  </form>
   </body>
</html>