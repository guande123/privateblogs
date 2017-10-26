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
  </head>

  <body>
     <header>
	   <ul>
    	<li> <img id="logo" src="../map/gor_logo.png" title="logo" /></li>
		<li class="search_li"> <input id="sousuo"  type="text" placeholder="输入博主名字" /><span class="search_icon"></span></li>
		<li> <?php 
		session_start();
		if(isset($_SESSION['res'])){
			echo '<span id="denglu" class="u_s"><a href="javascript:void(0)">'.$_SESSION['res']->username.'</a></span>';
		}else{
			//未登录的,避免用户直接用url进入myblogs。
			header("location:../main.php");
			//echo '<span id="denglu" class="u_s"><a href="usertologin/login.php">登录</a></span>';
	}?>|
		 <span id="zuche" class="u_s"><a href="logout.php">注销</a></span>
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
						<li><a id="a_verify_code" href="javascript:void(0);">提交审核的博文(<?php 
						 $bmobObj= new BmobObject("BlogList");           
						 $where = 'where={"VerifyCode":1,"user_id":"'.$_SESSION["res"]->objectId.'"}';
						$res=$bmobObj->get("",array($where));
						echo count($res->results)?>)</a></li>
						<li><a href="myalbum.php">图片</a></li>
						<?php if($_SESSION['res']->isManager){
							echo "<li><a href='managerblogs.php'>博文管理</a></li>";
						}?>
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
				echo '<ul>
					  <li><a href="javascript:void(0);">加好友</a></li>
					  <li><a href="javascript:void(0);">私信</a></li>
					  <li><a href="myalbum.php">我的图片</a></li>
					  <li><a href="../userinfo/userInfo.php">我的资料</a></li>
					  <li><a href="writeblogs.php">写博文</a></li>
					  </ul>'; 
			 }else{
				 echo '<p class="dengluA"><a href="usertologin/login.php">点击登录</a></p>';
			 }
		   ?>     
		   </div>
			<div class="blogsList">		
		      <p>博文</p>    
			  <?php 
			     $num=0;
				 $bmobObj= $results ="";
			     try{
					 $bmobObj= new BmobObject("BlogList");
					 $where = 'where={"user_id":"'.$_SESSION['res']->objectId.'"}';
					 $res=$bmobObj->get("",array($where,'limit=8'));
	    			 $results = $res->results ;		
					 $num = count($results);
					 if($num>0){
						echo "<table id='c_table'>";
						echo "<tr>";
						echo "<td><b>博主</b></td>";
						echo "<td><b>标题</b></td>";
						echo "<td><b>时间</b></td>";
						echo "<td><b>状态</b></td>";
						echo "<td><b>操作</b></td>";
						echo "</tr>";
						$bmobObj= new BmobObject("_User");			 
						for($i=0;$i<$num;$i++){
							$col =  $results[$i];
							$res=$bmobObj->get($col->user_id);
							echo "<tr>";
							echo "<td>".$res->username."</td>";
							echo "<td><a href='blogsInfo.php?user_id=$col->user_id&blog_id=$col->objectId&createdAt=$col->createdAt&name=$res->username&title=$col->title'>".$col->title."</a></td>";
							echo "<td>".$col->createdAt."</td>";
							switch($col->VerifyCode){
								case 0: echo "<td>保存为草稿</td>";
								   break;
								case 1:echo "<td>审核中</td>";
								   break;
								case 2:echo "<td>审核未通过</td>";
								   break;
								case 3:echo "<td id='td_xiajia'>发表ing<a href='javascript:void(0);' onclick='xiajia(\"$col->objectId\")'>点击下架</a></td>";
								   break;	
								case 4:echo "<td>已下架</td>";
								   break;
							} 
							echo "<td><a href='editblogs.php?user_id=$col->user_id&blog_id=$col->objectId&verifyCode=$col->VerifyCode'>编辑</a>";
							echo "|<a href='javascript:void(0);' onclick='del(\"$col->objectId\")'>删除</a></td>";
							echo "</tr>";			
						}
					    $shang = floor($num/8);
						$yeshu=1;
						($num%8!=0)?($yeshu=$shang+1):($yeshu=$shang);
						($yeshu<5)?$yeshu:($yeshu=5);
						$start = 1;
						echo "</table>";
						echo "<div class='page_div'>";
						echo '<a id="pageUp" href="javascript:void(0)" onclick="javascript:preview();">上一页</a>';
						for($i=0;$i<$yeshu;$i++){
							echo "<a class='a_page' href='javascript:void(0)' onclick='javascript:curClick(this);'> $start </a>";
							 $start++;
						}
						echo '<a id="pageDown" href="javascript:void(0)"  onclick="javascript:next();">下一页</a> ';				
					    echo "<span>共".$num."条</span></div>";
					}else{
						echo "还没有任何博主发文！！！"; 
					 }
					 
				 }catch(Exception $e){
					 echo "网络获取内容失败：".$e->getMessage()."<br/>";
				 }?>
			   </div>
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
	 var table =   document.getElementById("c_table");
	var pageUp =  document.getElementById("pageUp");
	var pageDown =  document.getElementById("pageDown");
	var blogList = document.getElementsByClassName("blogsList")[0];
	var page_count = 0;
	function next(){
		return;
		if(page_count*8><?php echo $num?>){
			return;
		}
		page_count++;
		url="blogpage2.php?count="+page_count;
		url = url+"&myblogs=true";
		connectServer(url)
	}
	function preview(){
		if(page_count==0){
			return;
		}
		page_count--;
		url="blogpage2.php?count="+page_count;
		url = url+"&myblogs=true";
		connectServer(url)
	}
	function curClick(obj){
		page_count = parseInt(obj.innerHTML);
		url="blogpage2.php?count="+page_count;
		url = url+"&myblogs=true";
		connectServer(url)
	}
	function del(id){
		url="blogpage2.php?count=0&blog_id="+id;
		connectServer(url)
	}	
	function xiajia(id){
		url="blogpage2.php?count=0&xiajia=true&blog_id="+id;
		connectServer(url)
	}
	function stateChanged(){
		if((xmlHttp.readyState ==4 ||xmlHttp.readyState=="complete")&&xmlHttp.status==200){
			var txt = xmlHttp.responseText;
		    blogList.innerHTML = txt;
		}
	}
  </script>
  
</html>