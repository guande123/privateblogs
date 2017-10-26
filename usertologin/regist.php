<html>
   <head>
		<title>user to regist</title>
<link rel="stylesheet" type="text/css" href="../css/default.css" />
<link rel="stylesheet" type="text/css" href="../css/header.css" />
<link rel="stylesheet" type="text/css" href="../css/navigation.css" />
<link rel="stylesheet" type="text/css" href="../css/content.css" />	
<link rel="stylesheet" type="text/css" href="../css/form.css" />	
   </head>

		<script type="text/javascript" src="js/asynchronous.js" ></script>
		<script type="text/javascript" src="../lib/webim.config.js" ></script>
		<script type="text/javascript" src="../lib/strophe-1.2.8.min.js" ></script>
		<script type="text/javascript" src="../lib/websdk-1.4.13.js" ></script>
   <body>
       <header>     
	   <ul>
			<li> <img id="logo" src="../map/gor_logo.png" title="logo" /></li>
			<li class="search_li"> <input id="sousuo"  type="text" placeholder="输入博主名字" /><span class="search_icon"></span></li>
			<li> <span id="zuche" class="u_s">注册ing</span></li>
	   </ul>
	 </header>
	 <content>
		<form id="regist_form"  action=""  enctype="application/x-www-form-urlencoded" > 
	      <h5>用户注册</h5>
		  <p class="u_para">  
		       <span class="u_label">*用户名:</span>
		       <input class="u_in" id="nameId" onblur="isNameCorrected(this);" type="text" name="username" placeholder="请设置用户名"/>
			    <span class="u_tips" id="name_tips"></span>
	      </p>
		  <p class="u_para">  
		       <span class="u_label">*密码:</span>
		       <input class="u_in" id="passwordId" onblur="isPasswordCorrected(this);" type="password" name="password"  placeholder="请设置密码"/>
	           <span class="u_tips" id="password_tips"></span>
		  </p>
		   <p class="u_para">  
		       <span class="u_label">*重复密码:</span>
		       <input class="u_in" id="repasswordId" onblur="isRepasswordCorrected(this);" type="password" name="repassword" placeholder="确认密码" />
	           <span class="u_tips" id="repassword_tips"></span>
		  </p>
		   <p class="u_para">  
		       <span class="u_label">*邮箱:</span>
		       <input class="u_in" id="emailId" onblur="isEmailCorrected(this);" type="text" name="email"  placeholder="可用于登录和找回密码"/>
	           <span class="u_tips" id="email_tips"></span>
		   </p>
		   <p class="u_para">  
		       <span class="u_label">*手机号码:</span>
		       <input class="u_in" id="phonenumberId" onblur="isPhoneNumCorrected(this);" type="text" name="phonenumber" placeholder="加强用户安全" />
	           <span class="u_tips" id="phonenumber_tips"></span>
		   </p>
		   <p class="u_para">
		        <span class="u_label">成为管理员:</span><input id="checkbox" type="checkbox" onclick="checkIsManager()" /><input  id="secretKey" type="hidden" name="secretKey"  placeholder="管理员专属密钥" />
		  </p>
		  <p class="u_para">
		       <input id="button" class="_btn" type="button" value="确认注册" onclick="formValidate();"  />
		  </p>
		
		</form>
	  </content>
	 <footer>
	    <p>本项目地址:广东交通职业技术学院/38栋/730</p>
		<p>Gordon,Giotto,Memory,Quan联合开发</p>
		<p>copyright:987945799@qq.com</p>
	 </footer>
   </body>
      <script type="text/javascript"  >
	  var checkbox = document.getElementById("checkbox");
	  var serectKey = document.getElementById("serectKey");
	  	//创建连接
	var conn = new WebIM.connection({
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
	var options = { 
    username: 'username',
    password: 'password',
    nickname: '',
    appKey: WebIM.config.appkey,
    success: function () { 
	  alert("IM注册成功");
	  window.location.href="login.php";
	},  
    error: function () { 
	  alert("IM注册失败");
	}, 
    apiUrl: WebIM.config.apiURL
  }; 
	    function stateChanged(){
		if((xmlHttp.readyState ==4 ||xmlHttp.readyState=="complete")&&xmlHttp.status==200){
			var txt = xmlHttp.responseText;
			btn.disabled="disabled";
			if(txt=="OK"){
				//当bmob成功注册用户时，response返回ok，进而注册环信IM用户
			 var username =  document.getElementById("nameId").value;
		     var password =  document.getElementById("passwordId").value;
			 //window.location.href="login.php";
			 options.username = username;
			 options.password = password;
			 conn.registerUser(options);//正式注册
			}else{
				alert("Bmob注册失败");
			}
		}
		}
	function checkIsManager()
	{
		var bool = 	checkbox.checked;
		if(bool){
			secretKey.type="text";
		}else{
			secretKey.type="hidden";
		}
	}
	  </script>
	     <script type="text/javascript" src="js/form_regist_validate.js" ></script>
</html>