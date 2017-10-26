<html>
  <head><title>我的博客首页！</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
	<?php
		include_once '../lib/BmobObject.class.php';
		include_once '../lib/BmobUser.class.php';
	?>   
<link rel="stylesheet" type="text/css" href="../css/default.css" />
<link rel="stylesheet" type="text/css" href="../css/header.css" />
<link rel="stylesheet" type="text/css" href="../css/navigation.css" />
<link rel="stylesheet" type="text/css" href="../css/content.css" />	
<style>
  #d_title p{
	  width:100%;
	  height:40px;
	  line-height:40px;
	  vertical-align:center;
  }
  #d_title span{
	  margin-right:10px;
  }
  #d_content{
	 width:100%;
	  height:100%;
	  border:1px solid #666;
	 box-shadow: 3px 3px 1px #888888;
  }
content{
	width:1024px;
}
</style>
  </head>
 <body>
     <header>     
	   <ul>
    	<li> <img id="logo" src="../map/gor_logo.png" title="logo" /></li>
		<li class="search_li"> <input id="sousuo"  type="text" placeholder="输入博主名字" /><span class="search_icon"></span></li>
		<li> <?php 
		session_start();
		if(isset($_SESSION['res'])){
			echo '<span id="denglu" class="u_s"><a href="myblogs.php">'.$_SESSION['res']->username.'</a></span>';
		}else{
			echo '<span id="denglu" class="u_s"><a href="usertologin/login.php">登录</a></span>';
			
		}?> |
		 <span id="zuche" class="u_s"><a href="../usertologin/regist.php">注册</a></span>
		 </li>
		 </ul>
	 </header>
	 <content>
	    <div id="d_title">
			<p align="center" >
			<?php if($_GET){
					echo "<span>博主:<b>".$_GET['name']."</b></span>";
					echo "<span>标题:<b>".$_GET['title']."</b></span>";
					echo "<span>时间:<b>".$_GET['createdAt']."</b></span>";
					}
					?>
			</p>
		</div>
		<div id="d_content"></div>
	 </content>
	 <footer>
	    <p>本项目地址:广东交通职业技术学院/38栋/730</p>
		<p>Gordon,Giotto,Memory,Quan联合开发</p>
		<p>copyright:987945799@qq.com</p>
	 </footer>
  </body>
  <?php
     if($_GET){
		 $userId = $_GET['user_id'];
		 $objectId = $_GET['blog_id'];
		 try{
			$bmobObj= new BmobObject("BlogList");
			$res=$bmobObj->get($objectId);
		    $content = $res->content;
		 }catch(Exception $e){
			 echo "服务器获取内容失败：".$e->getMessage()."<br/>"; 
		 }
	 }
  ?>
  <script type="text/javascript">
   //  var ue = UE.getEditor("editor");
	 var d_content = document.getElementById("d_content");
     var content='<?php echo $content?>';
	 d_content.innerHTML = content;
  </script>
</html>