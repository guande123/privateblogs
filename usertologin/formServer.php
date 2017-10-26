<?php
	include_once '../lib/BmobObject.class.php';
    include_once '../lib/BmobUser.class.php';
    include_once '../lib/BmobSms.class.php';
	 $bmobUser = new BmobUser();
	 $bmobSms = new BmobSms();
     $phoneNumber = "";
	if($_SERVER["REQUEST_METHOD"]=="GET"){
	   if(isset($_GET["code"])){
		    $email =  $_GET["email"];
	        $res = $bmobUser->get();
			for($i=0;$i<count($res->results);$i++){
			 if($email==$res->results[$i]->email){
				 $phoneNumber = $res->results[$i]->mobilePhoneNumber;
                 $bmobSms->sendSmsVerifyCode($phoneNumber,true);	//发送短信获取验证码			 
  
               //获得当次session
				session_id(1001);
				session_start();
				$SESSION['phonenumber'] = $phoneNumber;
	 

				//	$res = $bmobUser->resetPasswordBySmsCode("111111", "134554"); // 使用短信验证码进行密码重置
			 
			    }
	     	}
		    echo "1001";
	   } 

	   
       if(isset($_GET["code2"])){
			//获得当次session
			session_id(1001);
			session_start();
			if(isset($_SESSION["phonenumber"])){
			    $phoneNumber =$_SESSION["phonenumber"];
		}else{
			echo "手机号码没有保存于session中";
		}
		
		 $password =  $_GET["password"];
     	 $res = $bmobUser->resetPasswordBySmsCode($phoneNumber,$password ); // 使用短信验证码进行密码重置
			 
		  echo "1002";
		}
	}
?>