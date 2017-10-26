<html>
  <head><title>我的博客首页！</title>
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <script type="text/javascript" src="../asynchronous.js" ></script> 
	<script type="text/javascript" src="checks.js" ></script>
   <script type="text/javascript" charset="utf-8" src="utf8-php/ueditor.config.js"></script>
   <script type="text/javascript" charset="utf-8" src="utf8-php/ueditor.all.min.js"> </script>
     <script type="text/javascript" charset="utf-8" src="utf8-php/lang/zh-cn/zh-cn.js"></script>
 <link rel="stylesheet" type="text/css" href="../css/default.css" />
<link rel="stylesheet" type="text/css" href="../css/header.css" />
<link rel="stylesheet" type="text/css" href="../css/navigation.css" />
<link rel="stylesheet" type="text/css" href="../css/content.css" />
<style type="text/css">
  content{
	  width:1024px;
	  height:500px;
  }
  .p_title{
	  margin:10px 0;
  }
  ._btn2{
	  margin:10px 0 0 5px;
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
	 <div class="fuwenben">
		 <p class="p_title"><span>请输出博文标题：</span>&nbsp;&nbsp;&nbsp;&nbsp;<input id="title1" type="text" />
		<span>选择标签：</span><select name="f_label" form="form1">  
			  <option value ="internet">IT、互联网</option>
			  <option value ="novel">小说</option>
			  <option value="realstory">真实故事</option>
			  <option value="historical">历史人文</option>
		</select></p>
	 <script id="editor" type="text/plain" style="width:1024px;height:300px;"></script>
	 <form id="form1" action="saveContent.php" method="POST">
	    <input id="content" type="hidden" name="content" />
		<input id="title2" type="hidden" name="title" />
		<input id="imgSrc" type="hidden" name="imgSrc" />
		<input id="draft" type="hidden" name="isDraft" value="false" />
	    <p align="right">
			<button class="_btn2" type="button" name="save_content" value="j_save" onclick="saveContent(0);" >保存并发表</button>
			<button class="_btn2" type="button" name="save_as_draft" value="d_save" onclick="saveContent(1);">保存为草稿</button>
	    </p>
	 </form>
	 </div>	

	 </content>
	 <footer>
	    <p>本项目地址:广东交通职业技术学院/38栋/730</p>
		<p>Gordon,Giotto,Memory,Quan联合开发</p>
		<p>copyright:987945799@qq.com</p>
	 </footer>
  </body>
  <script type="text/javascript">
     var ue = UE.getEditor("editor");
	 var form = document.getElementById("form1");
	 var titleInp = document.getElementById("title1");
	 var titleInp2 = document.getElementById("title2");
	 var contentInp = document.getElementById("content");
	 var imgSrcInp = document.getElementById("imgSrc");
	 var draftInp = document.getElementById("draft");
	 var compare = arraylist();//敏感词数组
	 function saveContent(num){
		var content =  ue.getContent();
		var t_val = titleInp.value;
		t_val=trim(t_val);
		for(var i=0;i<compare.length;i++){
			var item = compare[i];
			if(content.indexOf(item)!=-1){
				alert("涉及敏感词汇:"+item+"位置"+content.indexOf(item));
				return item;
			}
			if(t_val.indexOf(compare[i])!=-1){
				alert("涉及敏感词汇:"+item);
				return item;
			}
		}

		if(t_val==""||t_val==null){
			alert("标题不能为空");
		   return;
		}
		//获取img的src；
        var imgSrc = getImgSrc(content);
		imgSrcInp.value= imgSrc;
		contentInp.value =content;
		titleInp2.value = titleInp.value;
		if(num==0){
			form.submit();
		}else{
			draftInp.value = "true";
			form.submit();
		}
		
	 }
	 // 截取src=""中的内容
	 function getImgSrc(content){
		 var imgSrc = new Array();
		 var arrIndex = 0;
		 var start_ind = "src=";
		 var end_ind = "\"";
		 var imgSrcJoin=null;
		 while(content.indexOf(start_ind)!=-1){
			var index  = content.indexOf(start_ind);
			if(index!=-1){
				content = content.substr(index+5);
			//	alert("第一次截取字符串:"+content);
				index =  content.indexOf(end_ind);			
				if(index!=-1){
					var slice = content.substr(0,index);
					alert("slice : "+slice);
					imgSrc[arrIndex] = slice;
					content = content.substr(index);
				//	alert("第二次截取字符串"+content);
				}
			}
			arrIndex++;
		 }
		 if(imgSrc.length>0){
			 imgSrcJoin = imgSrc.join(";");
		 }
		 return imgSrcJoin;
	 }
	  //删除String左右两端的空格
	　 function trim(str){
		if(str==null)
			return str;
　　     return str.replace(/(^\s*)|(\s*$)/g, "");
　　 }

  </script>
</html>