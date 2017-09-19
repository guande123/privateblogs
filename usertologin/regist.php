<html>
   <head><title>user to regist</title></head>
   <script type="text/javascript" src="js/form_regist_validate.js" ></script>
   <body>
     <form id="regist_form" action="regist_validate.php" method="POST"> 
	      <h5>用户注册</h5>
		  <p class="u_para">  
		       <span class="u_label">*用户名：</span>
		       <input id="nameId" onblur="isNameCorrected(this);" type="text" name="username" />
			    <span class="u_label" id="name_tips"></span>
	      </p>
		  <p class="u_para">  
		       <span class="u_label">*密码：</span>
		       <input id="passwordId" onblur="isPasswordCorrected(this);" type="password" name="password" />
	           <span class="u_label" id="password_tips"></span>
		  </p>
		   <p class="u_para">  
		       <span class="u_label">*重复密码：</span>
		       <input id="repasswordId" onblur="isRepasswordCorrected(this);" type="password" name="repassword" />
	           <span class="u_label" id="repassword_tips"></span>
		  </p>
		   <p class="u_para">  
		       <span class="u_label">*邮箱：</span>
		       <input id="emailId" onblur="isEmailCorrected(this);" type="text" name="email" />
	           <span class="u_label" id="email_tips"></span>
		   </p>
		   <p class="u_para">  
		       <span class="u_label">*手机号码：</span>
		       <input id="phonenumberId" onblur="isPhoneNumCorrected(this);" type="text" name="phonenumber" />
	           <span class="u_label" id="phonenumber_tips"></span>
		   </p>
		  <p class="u_para">
		       <input type="button" value="确认注册" onclick="formValidate();" />
		  </p>
		
	  </form>
   </body>
 
</html>