<html>
   <head><title>user to login</title>
    <script type="text/javascript" src="js/asynchronous.js"></script>
 
   </head>
   <body>
   <div id="form_1_div">
       <form action="#" method="GET"> 
	      <h5>密码找回！</h5>
		  <p class="u_para">  
		       <span class="u_label">输入邮箱：</span>
		       <input id="email" type="text" name="email" placeholder="邮箱"  />
			   <input id="code" type="hidden" name="code" value="code" />
	           <input type="button" name="btnCode" value="获取验证码" onclick="compileUrl()"/>
			   <span id="email_tips"></span>
		  </p>	
	  </form>
	</div>
	<div id="form_2_div" style="display:none;">
	  <form action="#" method="POST"> 
	      <h5>密码找回2！</h5>
		  <p class="u_para">  
		       <span class="u_label">输入验证码：</span>
		       <input id="email" type="text" name="verifycode"  />
			 
	      </p>
		  <p>
		   <span class="u_label">输入新密码：</span>
		       <input id="password" type="text" name="password"  />
			   <span id="password_tips"></span>
		  </p>	
		  <input type="hidden" name="code2" value="code2" />
		  <p><input type="submit" value="确认修改" /></p>
	  </form>
	  </div>
	  <div form="form_3_div" style="display:none;">
	    <form action="login.php" method="POST"> 
	      <h5>密码找回成功！</h5>
		  <p><input type="submit" value="点击返回" /></p>
		</form>
	  </div>
	    <span id="email_tips"></span>
   </body>
      <script type="text/javascript" >
	//窗口加载完成够调用的函数
	    /*  window.onload = function(){
			     var url = compileUrl();
			     connectServer(url);
		  }*/
		 var Form1="1001";
         var Form2="1002";
		  //表单提交并重组url
	      function compileUrl(){
		      var hiddenCode = document.getElementById("code");
			  var email  = document.getElementById("email");
			  var url = "formServer.php?";
			  url = url+hiddenCode.name+"="+hiddenCode.value;
			  url = url+"&"+email.name+"="+email.value;
			  
			  connectServer(url);
		
		  }
		 // div的visibility可以控制div的显示和隐藏，但是隐藏后页面显示空白 
		 //通过设置display属性可以使div隐藏后释放占用的页面空间如下 
		  function nextForm(num,txt){
			  var  divForm1 =document.getElementById("form_1_div");
			  var  divForm2 =document.getElementById("form_2_div");
			  var  divForm3 =document.getElementById("form_3_div");
			  var email_tips = document.getElementById("email_tips");
			  if(num==1){
				    divForm1.style.display="none";
					divForm2.style.display="";
			  }else if(num==2){
				  divForm2.style.display="none";
				//  divForm3.style.display= "";
			  }else{
				  email_tips.innerHTML = txt;
			  }
		  }
		  
		  	//override XMLHttp 
	//浏览器收到服务器响应后调用的函数
	function stateChanged(){
		if((xmlHttp.readyState ==4 ||xmlHttp.readyState=="complete")&&xmlHttp.status==200){
			var txt = xmlHttp.responseText;
			if(txt==Form1){
				nextForm(1,txt);//回调，显示下一个表单，待修改
			}else if(txt==Form2){
				nextForm(2,txt);//回调，显示下一个表单，待修改
			}else{
			nextForm(3,txt);//回调，显示下一个表单，待修改
			}
		}
	</script>
</html>