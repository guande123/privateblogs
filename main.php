<html>
  <head><title>博客首页</title>  
<link rel="stylesheet" type="text/css" href="css/default.css" />
<link rel="stylesheet" type="text/css" href="css/header.css" />
<link rel="stylesheet" type="text/css" href="css/navigation.css" />
<link rel="stylesheet" type="text/css" href="css/content.css" />
  	<?php
		include_once 'lib/BmobObject.class.php';
		include_once 'lib/BmobUser.class.php';
	?> 
  </head>
  <body>
     <header>     
	   <ul>
    	<li> <img id="logo" src="map/logo_fanchuan.png" title="logo" /></li>
		<li class="search_li"> <input id="sousuo"  type="text" placeholder="输入博主名字" /><span class="search_icon"></span></li>
		<li> <?php 
		session_start();
		if(isset($_SESSION['res'])){
			echo '<span id="denglu" class="u_s"><a href="blogsarea/myblogs.php">'.$_SESSION['res']->username.'</a></span>';
		}else{
			echo '<span id="denglu" class="u_s"><a href="usertologin/login.php">登录</a></span>';
			
		}?> |
		 <span id="zuche" class="u_s"><a href="usertologin/regist.php">注册</a></span>
		 </li>
		 </ul>
	 </header>
	 <content>
	     <div class="navigation">
		     <div class="nav_l"></div>
			 <div class="nav_r">
			    <div class="nav_r_wrap">
				    <h3>GG帆云</h3>
					<a href="javascript:void(0);">--- 一个专注创作、交流、分享的博客网站</a>
					<ul>
						<li><a href="javascript:void(0);">首页</a></li>
						<li><a href="javascript:void(0);">博文目录</a></li>
						<li><a href="javascript:void(0);">图片</a></li>
						<li>
							<select id="select" name="f_label" onchange="onValChange()">  
							      <option value ="allLabel">显示所有标签</option>
								  <option value ="internet">IT、互联网</option>
								  <option value ="novel">小说</option>
								  <option value="realstory">真实故事</option>
								  <option value="historical">历史人文</option>
							</select>
						</li>
					</ul>
				</div>
			</div>
		 </div>
		 <div class="c_body"> 
			<div class="user_nav">
			<p class="p_tips">个人资料</p>
		    <img id="logo" src="map/touxiang.fw.png" title="big_logo"  />
		   <?php
		     if(isset($_SESSION['res'])){
				echo '<ul>
					  <li><a href="javascript:void(0);">加好友</a></li>
					  <li><a href="javascript:void(0);">私信</a></li>
					  <li><a href="blogsarea/myalbum.php">我的图片</a></li>
					  <li><a href="userinfo/userInfo.php">我的资料</a></li>
					  <li><a href="blogsarea/writeblogs.php">写博文</a></li>
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
						$bmobObj = new BmobObject("BlogList");
						$res = $bmobObj->get("",array('where={"VerifyCode":3}'));//查询所有通过审核的数据
						$num = count($res->results);//结果集
						$res = $bmobObj->get("",array('where={"VerifyCode":3}','limit=8','skip=0','order=isTop'));//分页查询通过审核的数据
						$results = $res->results;
						$bmobUser = new BmobUser("_User");//获取每个博主的名字
						echo "<table id='c_table'>";
						echo "<tr>";
						echo "<td><b>博主</b></td>";
						echo "<td><b>标题</b></td>";
						echo "<td><b>时间</b></td>";
						echo "</tr>";
						for($i=0;$i<count($results);$i++){
							$col = $results[$i];
							$user = $bmobUser->get($col->user_id);
							echo "<tr>";
							echo "<td> $user->username </td>";
							echo "<td><a href='blogsarea/blogsInfo.php?user_id=$col->user_id&blog_id=$col->objectId'>".$col->title."</a></td>";
							echo "<td>$col->createdAt </td>";
							echo "</tr>";
						}
						echo "</table>";
						echo "<div class='page_div'><a id='pageUp' href='javascript:void(0)' onclick='javascript:preview();'>上一页</a>";
						$yeshu=1;
						 $shang = floor($num/8);
						($num%8!=0)?($yeshu=$shang+1):($yeshu=$shang);
						($yeshu<5)?$yeshu:($yeshu=5);
						for($i=0;$i<$yeshu;$i++){
							echo "<a class='a_page' href='javascript:void(0)' onclick='javascript:curClick(this);'>".($i+1)."</a>";
						}
						echo "<a id='pageDown' href='javascript:void(0)' onclick='javascript:next();'>下一页</a></div>";
				 }catch(Exception $e){
					 echo "网络获取内容失败：".$e->getMessage()."<br/>";
				 }?>
			</div>
		 </div>
     </content>
	 <footer>
	    <p>本项目地址:广东交通职业技术学院/38栋/730</p>
		<p>Gordon,Giotto,Memory,Quan联合开发</p>
		<p>copyright:987945799@qq.com</p>
	 </footer>
  </body>
    <script type="text/javascript" src="asynchronous.js"></script>
  <script language="javascript">
    var table =   document.getElementById("c_table");
	var pageUp =  document.getElementById("pageUp");
	var pageDown =  document.getElementById("pageDown");
	var select =  document.getElementById("select");
	var blogList = document.getElementsByClassName("blogsList")[0];
	var page_count = 1;
	function next(){
		alert(page_count);
		if(page_count*8><?php echo $num?>){
			return;
		}
		page_count++;
		url="blogpage.php?count="+page_count;
		url=url+"&label="+select.value;
		connectServer(url)
	}
	function preview(){
		if(page_count==0){
			return;
		}
		page_count--;
		url="blogpage.php?count="+page_count;
		url=url+"&label="+select.value;
		connectServer(url)
	}
	function curClick(obj){
	
		page_count = parseInt(obj.innerHTML);
		url="blogpage2.php?count="+page_count;
		url=url+"&label="+select.value;
		connectServer(url)
	}
	function stateChanged(){
		if((xmlHttp.readyState ==4 ||xmlHttp.readyState=="complete")&&xmlHttp.status==200){
			var txt = xmlHttp.responseText;
		    blogList.innerHTML = txt;
		}
	}
	
	function onValChange(){
		var val = select.value;
		url="blogpage.php?count=0&label="+val;
		connectServer(url)
	}
  </script>
</html>