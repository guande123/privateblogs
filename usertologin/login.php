<html>
   <head><title>user to login</title>
 <link rel="stylesheet" type="text/css" href="../css/default.css" />
<link rel="stylesheet" type="text/css" href="../css/header.css" />
<link rel="stylesheet" type="text/css" href="../css/navigation.css" />
<link rel="stylesheet" type="text/css" href="../css/content.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />

		<script type="text/javascript" src="../lib/webim.config.js" ></script>
		<script type="text/javascript" src="../lib/strophe-1.2.8.min.js" ></script>
		<script type="text/javascript" src="../lib/websdk-1.4.13.js" ></script>
		<script type="text/javascript" src="js/asynchronous.js" ></script>
		<style>
	     ._btn{
			height:50px;
			width:150px;
			background-color:#3F89EC;
			color:#FFFFFF;
			font-size:16px;
			border:none;
			border-radius:5px;
		}
		._btn:nth-child(1){
			margin-left:140px;
		}
		#login_form{
			padding-top:142px;
		}
		</style>
   </head>
   <body>
    <header>     
	   <ul>
    	<li> <img id="logo" src="../map/gor_logo.png" title="logo" /></li>
		<li class="search_li"> <input id="sousuo"  type="text" placeholder="输入博主名字" /><span class="search_icon"></span></li>
		<li><span>登录ing</span></li>
	  </ul>
	 </header>
	 <content>
      <form id="login_form" action="" enctype="applcation/x-www-form-urlencoded" method="POST"> 
	      <h5>用户登录</h5>
		  <p class="u_para">  
		       <span class="u_label">用户名：</span>
		       <input  id="email" class="u_in" type="text" name="email" placeholder="邮箱"  />
			   <span id="email_tips"></span>
	      </p>
		  <p class="u_para">  
		       <span class="u_label">密码：</span>
		       <input id="password" class="u_in" type="password" name="password" />
	      </p>
		  <p class="u_para">
		       <input type="button" class="_btn" value="登陆" onclick="javascript:ajaxConn();" />
			   <input type="button" class="_btn" value="注册" onclick="javascript:window.location.assign('regist.php');" />
		       <a href="findpassword.php">忘记密码？</a>
		  </p>


	  </form>
	  </content>
	  	 <footer>
	    <p>本项目地址:广东交通职业技术学院/38栋/730</p>
		<p>Gordon,Giotto,Memory,Quan联合开发</p>
		<p>copyright:987945799@qq.com</p>
	 </footer>
   </body>

     <script type="text/javascript">
	 //登陆失败显示提示文本
	 function  loginFailedTxt(){
		 var spanTips = document.getElementById("email_tips");
		 spanTips.style.color = "red";
		 spanTips.innerHTML ="用户名或者密码错误！！";
	 }
	 var conn, options;
	 var email = document.getElementById("email");
     var password =document.getElementById("password");

	 window.onload = function(){
	 	  	//创建连接
	conn = new WebIM.connection({
		isMultiLoginSessions: WebIM.config.isMultiLoginSessions,
		https: typeof WebIM.config.https === 'boolean' ? WebIM.config.https : location.protocol === 'https:',
		url: WebIM.config.xmppURL,
		heartBeatWait: WebIM.config.heartBeatWait,
		autoReconnectNumMax: WebIM.config.autoReconnectNumMax,
		autoReconnectInterval: WebIM.config.autoReconnectInterval,
		apiUrl: WebIM.config.apiURL,
		isAutoLogin: true
       });
	   	//根据用户名/密码/昵称注册环信 Web IM:
	 options = { 
		  apiUrl: WebIM.config.apiURL,
		  user: 'username',
		  pwd: 'password',
		  success:function(){
			  //请检查登录成功后是否调用过 conn.setPresence();。
			  conn.setPresence();
			  alert("登录成功");
			  window.location.href='../blogsarea/myblogs.php';
		  },
		   error: function(){
		   alert("登录失败");   
		   },
		  appKey: WebIM.config.appkey
		};
	 }


 function ajaxConn(){
		 url = "login_validate.php?email="+email.value;
		 url = url+"&password="+password.value;
		 connectServer(url,"POST");
	  }
   function stateChanged(){
		if((xmlHttp.readyState ==4 ||xmlHttp.readyState=="complete")&&xmlHttp.status==200){
			var txt = xmlHttp.responseText;
			var str = txt.split("~");
			// alert( str[0]+str[1]);
			if( str[0] == "true"){
				//当bmob成功登录用户时，response返回ok和username，进而登陆环信IM用户
		    window.location.href='../blogsarea/managerblogs.php';
		//环信的sdk在登录时出现的问题	
	   // websdk-1.4.13.js:10731 Uncaught TypeError: conn.onError is not a function 
		  /*   var username = str[1];
		     var pwd =  password.value;
			 options.user = username;
			 options.pwd = pwd;
			 alert( options.user+ options.pwd);
			 conn.open(options);//登录之后需要设置在线状态，才能收到消息。
		*/
			}else if( str[0]=="false"){
				 window.location.href='../blogsarea/myblogs.php';
			}else{
				 alert("登录失败!");
			}
		}
		}

   </script>

</html>