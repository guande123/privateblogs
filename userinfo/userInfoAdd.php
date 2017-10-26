<html>
  <head><title>博客首页</title>  
<link rel="stylesheet" type="text/css" href="../css/default.css" />
<link rel="stylesheet" type="text/css" href="../css/header.css" />
<link rel="stylesheet" type="text/css" href="../css/navigation.css" />
<link rel="stylesheet" type="text/css" href="../css/content.css" />
<link rel="stylesheet" type="text/css" href="../css/form.css" />
<style>
  ._btn{
	  margin-right:100px;
  }
</style>
  </head>

  <body>
     <header>
	   <ul>
    	<li> <img id="logo" src="../map/gor_logo.png" title="logo" /></li>
		<li> <input id="sousuo"  type="text" placeholder="输入博主名字" /></li>
		<li> <?php 
		session_start();
		if(isset($_SESSION['res'])){
			echo '<span id="denglu" class="u_s"><a href="../blogsarea/myblogs.php">'.$_SESSION['res']->username.'</a></span>';
		}else{
			echo '<span id="denglu" class="u_s"><a href="../usertologin/login.php">登录</a></span>';
			
		}?>|
		 <span id="zuche" class="u_s"><a href="../usertologin/regist.php">注册</a></span>
		 </li>
	 </header>
	 <content>
		   <div class="user_form">
		         <form id="user_info_form" action="" method="GET">
				      <h5>个人资料填写</h5>
					  <p class="u_para">  
						   <span class="u_label">昵称*:</span>
						   <input class="u_in" id="nickname" type="text" name="nickname" placeholder="例如:nick"/>
						   <span class="u_label" ></span>
					  </p>
					  <p class="u_para">  
						   <span class="u_label">所在地*:</span>
						   <input class="u_in" id="place" type="text" name="place" placeholder="例如:广东交通职业技术学院"/>
						   <span class="u_label" ></span>
					  </p>
					  <p class="u_para">  
						   <span class="u_label" >生日:</span>
					        <input class="u_in" id="time" type="text" name="time" placeholder="  格式:2000/01/01"/>
							 <span id="time_sp" class="u_label" ></span>
					  </p>
					  <p class="u_para">
					        <textarea id="textarea" rows="3" cols="48" form="user_info_form" maxlength="50" placeholder="个性签名(50个字以内)"></textarea>
					  </p> 
					  <p class="u_para">  
						   <span class="u_label">性别*:</span>
						   <input id="maleChecked" type="radio" name="gender" value="男" checked="checked"/>男
						   <input  type="radio" name="gender"  value="女" />女
					  </p>
			          <p class="u_para">
							<input class="_btn" id="button" type="button" value="提交" onclick="formSubmit()"  />
					  </p>
				
				 </form>
		   </div>
		 </div>
     </content>
	 <footer>
	    <p>本项目地址:广东交通职业技术学院/38栋/730</p>
		<p>Gordon,Giotto,Memory,Quan联合开发</p>
		<p>copyright:987945799@qq.com</p>
	 </footer>
  </body>
    <script type="text/javascript" src="../asynchronous.js" ></script>
	<script language="javascript" src='checks.js'></script>
	
  <script type="text/javascript" >
    var compare = arraylist();    
	   function verifyWord(word){
	  	  for(var i =0;i<compare.length;i++){
		  if(compare.indexOf(word)!=-1){
			  alert("不合法词汇:"+word);
			  return false;
		  }
	  } 
	  return true;
   }
	function formSubmit(){
			  var nickname = document.getElementById("nickname").value;
			    var place = document.getElementById("place").value;
				  var maleChecked = document.getElementById("maleChecked").checked;
				    var time = document.getElementById("time").value;
					 var textarea = document.getElementById("textarea").value;
					  var time_sp = document.getElementById("time_sp");
					  (maleChecked == true)?maleChecked ="男":maleChecked = "女";
					  if(!verifyWord(nickname)){
						 return ;  
					  }				
					  if(!verifyWord(place)){
						 return ;  
					  }
					  if(!verifyWord(textarea)){
						 return ;  
					  }					  
					 if(isNaN(Date.parse(time))){
						 time_sp.style.color = "red";
						 time_sp.innerHTML = "时间格式不正确";
					 }else{
						 url = "userInfoAdd2.php?nickname="+nickname;
						 url =url+"&place="+place;
						 url =url+"&maleChecked="+maleChecked;
						 url = url+"&time="+time;
						 url = url+"&textarea="+textarea;
						 connectServer(url);
					 }
		 }
		 function stateChanged(){
			if((xmlHttp.readyState ==4 ||xmlHttp.readyState=="complete")&&xmlHttp.status==200){
			var txt = xmlHttp.responseText;
			if(txt=="OK"){
			   alert("添加成功");
			}
		} 
	}
  </script>
</html>