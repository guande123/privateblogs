<html>
   <head><title>user to login</title></head>
   <body>
      <form action="login_validate.php" method="POST"> 
	      <h5>用户登录</h5>
		  <p class="u_para">  
		       <span class="u_label">用户名：</span>
		       <input type="text" name="email" placeholder="邮箱" onblur="connectServer();" />
			   <span id="email_tips"></span>
	      </p>
		  <p class="u_para">  
		       <span class="u_label">密码：</span>
		       <input type="password" name="password" />
	      </p>
		  <p class="u_para">
		       <input type="submit" value="登陆" />
			   <input type="button" value="注册" onclick="javascript:window.location.assign('regist.php');" />
		  </p>
		  <p class="u_para"><a href="#">忘记密码？</p>
	  </form>
   </body>
     <script type="text/javascript">
    var xmlHttp = getXMLHttpRequest();
  //不同的浏览器使用不同的方法创建XMLHttpRequest对象
    function getXMLHttpRequest(){
	 var XMLHTTP=null;
	   if(window.XMLHttpRequest){
		   //firefox,opera 8.0+,safari;
		   XMLHTTP  = new XMLHttpRequest();
	   }else if(window.ActiveXObject){
		   try{
			   //IE6 or above
			   XMLHTTP= new ActiveXObject("Msxml2.XMLHTTP");
		   }catch(e){
			      XMLHTTP = new ActiveXObject("Microsoft.XMLHTTP");
		   }
		  }
		return XMLHTTP;
	}
	function connectServer(){
    xmlHttp.onreadystatechange=stateChanged ;//设置回调函数
    xmlHttp.open("GET",url,true) ;  //与服务器建立连接
    xmlHttp.send(null) ;// 发送请求    
	}
     
	//override XMLHttp 
	//浏览器收到服务器响应后调用的函数
	function stateChanged(){
		if(XMLHttp.readyState ==4 ||XMLHttp.readyState=="complete"){
			var txt = XMLHttp.responseText;
		}
	}  
   </script>
</html>