<html>
  <head><title>博客首页</title>  
<link rel="stylesheet" type="text/css" href="../css/default.css" />
<link rel="stylesheet" type="text/css" href="../css/header.css" />
<link rel="stylesheet" type="text/css" href="../css/navigation.css" />
<link rel="stylesheet" type="text/css" href="../css/content.css" />
<style>
   ._ziliao{
	   font-size:22px;
	   height:40px;
	   line-height:40px;
	   vertical-align:center;
	   overflow:hidden;
	   text-overflow:ellipsis;
   }
   ._ziliao:nth-last-child(1){
	   text-align:right;
   }
</style>
  </head>
	<?php
		include_once '../lib/BmobObject.class.php';
		include_once '../lib/BmobUser.class.php';
	?>  
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
	     <div class="navigation">
			 <div class="nav_l"></div>
			 <div class="nav_r">
			    <div class="nav_r_wrap">
				    <h3>我的博客网站</h3>
					<a href="../main.php">http://locahost:8080/privateblogs/main.php</a>
					<ul>
						<li><a href="../main.php">首页</a></li>
						<li><a href="javascript:void(0);">博文目录</a></li>
						<li><a href="../blogsarea/myalbum.php">图片</a></li>
					</ul>
				</div>
			</div>
		 </div>
		 <div class="c_body">
		   <div class="user_nav">
			<p class="p_tips">个人资料</p>
		    <img id="logo" src="../map/chimian.fw.png" title="big_logo"  />
		   <?php
		     if(isset($_SESSION['res'])){
				echo '<ul id="user_nav_show">
					  <li><a href="#"><span>加好友</span></a></li>
					  <li><a href="#"><span>私信</span></a></li>
					  <li><a href="../blogsarea/myalbum.php"><span>我的图片</span></a></li>
					  <li><a href="../userinfo/userInfo.php">我的资料</a></li>
					  <li><a href="../blogarea/writeblogs.php">写博文</a></li>
					</ul>'; 
			 }else{
				 echo '<a href="../usertologin/login.php">点击登录</a>';
			 }
		   ?> 
		   </div>
		   <div class="user_form blogsList">
		      <p>博文</p>
		      <?php
				     try{
					 $bmobObj= new BmobObject("User_info");
					 $where = 'where={"user_id":"'.$_SESSION['res']->objectId.'"}';
					 $res=$bmobObj->get("",array($where));
					 // object(stdClass)#5 (1) { ["results"]=> array(2) { [0]=> object(stdClass)#3 (6) { ["content"]=> string(250) "
					 $results = $res->results ;		//查询到User_info表中的所有行
					 $num = count($results);
					 if($num>0){		 
						//判断是否当前用户
							echo "<p class='_ziliao'>博主：".$_SESSION['res']->username."</p>";
							echo "<p class='_ziliao'>昵称：".$results[0]->nickname."</p>";
							echo "<p class='_ziliao'>所在地：".$results[0]->address."</p>";
							echo "<p class='_ziliao'>性别：".$results[0]->gender."</p>";
							echo "<p class='_ziliao'>个性签名：".$results[0]->void."</p>";
					    	echo "<p class='_ziliao'><a href='userInfoAdd.php'>点击编辑</a></p>"; 
					 }else{
						 echo "该博主还没填写个人资料！！！<a href='userInfoAdd.php'>点击编辑</a>"; 
					 } 
				 }catch(Exception $e){
					 echo "服务器获取内容失败：".$e->getMessage()."<br/>";
				 }   
				 ?>
		   </div>
		 </div>
     </content>
	 <footer>
	    <p>本项目地址:广东交通职业技术学院/38栋/730</p>
		<p>Gordon,Giotto,Memory,Quan联合开发</p>
		<p>copyright:987945799@qq.com</p>
	 </footer>
  </body>
</html>