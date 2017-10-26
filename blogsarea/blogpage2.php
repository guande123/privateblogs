<?php
  include_once '../lib/BmobObject.class.php';
  include_once '../lib/BmobUser.class.php';
	session_start();
	 $num=0;
	 $bmobObj= $results ="";
	 $bmobObj= new BmobObject("BlogList");
	 if(isset($_GET['xiajia'])){
		$bmobObj->update($_GET['blog_id'],array("VerifyCode"=>4));
	 }else{
	   $bmobObj->delete($_GET['blog_id']); 
	 }

	 try{
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
	 }
?>