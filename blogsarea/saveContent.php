<?php
  include_once '../lib/BmobObject.class.php';
  include_once '../lib/BmobUser.class.php';
    session_start();
	if($_POST){
	  //获取表单内容
	  $content = $_POST['content'];
	  $title = $_POST['title'];
	  $imgSrc = $_POST['imgSrc'];
	  $isDraft = $_POST['isDraft'];
	  $arr = array("content"=>$content,"title"=>$title,"user_id"=>$_SESSION['res']->objectId);
	 try{
	  $bmobObj = new BmobObject("BlogList");
	  if(isset($_POST['verifyCode'])){//此处为更新的内容
		  $verifyCode = $_POST['verifyCode'];
		  $blogId = $_POST['blogId'];
		  if($verifyCode!=3||$verifyCode!=0){//不是草稿也不是通过审核的文章，重新提交审核
			    $arr = array_merge($arr,array("VerifyCode"=>1));
		  }else{
			    $arr = array_merge($arr,array("VerifyCode"=>$verifyCode));  
		  }
		  $bmobObj->update($blogId,$arr);
	  }else{
		  if($isDraft=="false"){
			//添加到BlogList  
			$label = $_POST['f_label'];
			$arr = array_merge($arr,array("VerifyCode"=>1,"label"=>$label));
			$res= $bmobObj->create($arr);
			// var_dump($res);
			$imgArr = explode(";",$imgSrc);
			$bmobObj = new BmobObject("Album");
			//相片添加到相册  
			for($i=0;$i<count($imgArr);$i++){
				$res =   $bmobObj->create(array("src"=>$imgArr[$i],"user_id"=>$_SESSION['res']->objectId));
			}
		  }else{
			//添加到草稿箱
		   $label = $_POST['f_label'];
		   $arr =  array_merge($arr,array("VerifyCode"=>0,"label"=>$label));
		  $res= $bmobObj->create($arr);
		  }
	 }
	   	header("location:myblogs.php");
	}catch(Exception $e){
		echo "错误信息:".$e->getMessage()."<br/>";
	    echo "保存内容失败！<br/>";
		echo "<a href='myblogs.php'>点击返回！</a>";
	}
	}else{
		echo "无效连接！<br/>";
		echo "<a href='myblogs.php'>点击返回！</a>";
	}
	
?>