<html>
  <head><title>我的博客</title>  
	<?php
		include_once '../lib/BmobObject.class.php';
		include_once '../lib/BmobUser.class.php';
	?>   
<link rel="stylesheet" type="text/css" href="../css/default.css" />
<link rel="stylesheet" type="text/css" href="../css/header.css" />
<link rel="stylesheet" type="text/css" href="../css/navigation.css" />
<link rel="stylesheet" type="text/css" href="../css/content.css" />
<style>
     .c_body{	
		 height:500px;
	 }
     .user_nav{		
		height:500px;
	 }
	.blogsList{
        height:500px;
	}
</style>
  </head>

  <body>
     <header>
	   <ul>
    	<li> <img id="logo" src="../map/gor_logo.png" title="logo" /></li>
		<li> <input id="sousuo"  type="text" placeholder="输入博主名字" /></li>
		<li>
	<?php 
		session_start();
		if(isset($_SESSION['res'])){
			echo '<span id="denglu" class="u_s"><a href="myblogs.php">'.$_SESSION['res']->username.'</a></span>';
		}else{
			//未登录的,避免用户直接用url进入myblogs。
			header("location:../main.php");
			//echo '<span id="denglu" class="u_s"><a href="usertologin/login.php">登录</a></span>';
	}?>|
		 <span id="zuche" class="u_s"><a href="../usertologin/regist.php">注册</a></span>
		 </li>
	 </header>
	 <content>
		 <div class="c_body">
			<div class="user_nav">
		    <div class="nav_l"></div>
			<p class="p_tips">个人资料</p>
		    <img id="logo" src="../map/chimian.fw.png" title="big_logo"  />
		   <?php
		     if(isset($_SESSION['res'])){
				echo '<ul>
					  <li><a href="javascript:void(0);">加好友</a></li>
					  <li><a href="javascript:void(0);">私信</a></li>
					  <li><a href="javascript:void(0);">我的图片</a></li>
					  <li><a href="../userinfo/userInfo.php">我的资料</a></li>
					  <li><a href="writeblogs.php">写博文</a></li>
					  </ul>'; 
			 }else{
				 echo '<p class="dengluA"><a href="usertologin/login.php">点击登录</a></p>';
			 }
		   ?>     
		   </div>
		   <div class="blogsList">
		      <p id="p_tips">
			  <?php 
			     try{
					 $bmobObj= new BmobObject("Album");
					 $res=$bmobObj->get("",array('where={}','limit=1000'));//测试
					 // object(stdClass)#5 (1) { ["results"]=> array(2) { [0]=> object(stdClass)#3 (6) { ["content"]=> string(250) "
					 $results = $res->results ;		
					 $num = count($results);
					 $userAlbum = array();//提取属于user的照片并存放
					 $index = 0;//$userAlbum 数组下标
				     for($i=0;$i<$num;$i++){
						  $col =  $results[$i];//每一行数据的object
						  if($_SESSION['res']->objectId == $col->user_id ){//匹配当前用户
						      $userAlbum [$index] = $col;
							  $index++;
					      }
					}
					$num = count( $userAlbum );
					if($num>0){	
							 // $createTime = $col->createdAt;//创建照片的时间
							  //按时间分类，分类规则，一周内的照片放在同一个区域中；
							  //时间顺序为倒叙待续。。。。
							  showPhoto($userAlbum); 
						
					 }else{
						 echo "当前相册还未添加任何照片！！！"; 
					 }
					 
				 }catch(Exception $e){
					 echo "服务器获取内容失败：".$e->getMessage()."<br/>";
				 }
				//输出每张图片
				function  showPhoto($userAlbum){
				    for($i=0;$i<count($userAlbum);$i++){//$userAlbum[$i]->title 
					   $src = $userAlbum[$i]->src;
					   echo '<img class="myImg" src="http://localhost:8080'.$src.'"  title="" />';
					}
				} 
			 ?></p>
		   </div>
		 </div>
     </content>
	 <footer>
	    <p>本项目地址:广东交通职业技术学院/38栋/730</p>
		<p>Gordon,Giotto,Memory,Quan联合开发</p>
		<p>copyright:987945799@qq.com</p>
	 </footer>
  </body>
  <script type="text/javascript" src="../usertologin/js/asynchronous.js"></script>
  <script type="text/javascript">
     function addFriend(){
        var name = prompt("请输入对方的名字","1");
		if(name!=null && name!=""){
		//	window.location.assign('login.php');	
		//ajax实现添加好友
		  url="myblog_add.php?username="+name;
		  connectServer(url);
		}else{
			alert("没输入任何内容");
		}
	
	 }
	 function stateChanged(){
		
	   if((xmlHttp.readyState ==4 ||xmlHttp.readyState=="complete")&&xmlHttp.status==200){
		  var txt = xmlHttp.responseText;
		  if(txt=="OK"){
			  alert('成功添加好友');
		  }else{
			  alert('添加好友失败!'); 
		  }
	   }
	 }
  </script>
  
</html>