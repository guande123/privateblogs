<?php
  include_once '../lib/BmobObject.class.php';
  include_once '../lib/BmobUser.class.php';
  if($_GET){
		  $id = $_GET['id'];
	      $reason = $_GET['reason'];
	      $bmobObj = new BmobObject('BlogList');
		  $res=$bmobObj->update($id,array("VerifyCode"=>2,"rejectReason"=>$reason)); 
	  
	 try{
	   $res =  $bmobObj->get("",array('where={"VerifyCode":3}','limit = 8','skip = 0'));//分页查询，skip为查询的起点
	   $results = $res->results ;		
	   $num = count($results);
	   if($num>0){
				echo "<table id='c_table'>";
				echo "<tr>";
				echo "<td><b>博主</b></td>";
				echo "<td><b>标题</b></td>";
				echo "<td><b>时间</b></td>";
				echo "<td><b></b></td>";
				echo "</tr>";
				$bmobObj= new BmobObject("_User");			 
				for($i=0;$i<$num;$i++){
					$col =  $results[$i];
					$res=$bmobObj->get($col->user_id);
					echo "<tr>";
					echo "<td>".$res->username."</td>";
					echo "<td><a href='blogsInfo.php?user_id=$col->user_id&blog_id=$col->objectId&createdAt=$col->createdAt&name=$res->username&title=$col->title'>".$col->title."</a></td>";
					echo "<td>".$col->createdAt."</td>";
				    echo "<td><a href='javascript:void(0);' onclick='xiajia(\"$col->objectId\")'>下架</a></td>";
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
				echo "<p>没有提交审核的博文！！！</p>"; 
			 }
		 }catch(Exception $e){
			 echo "网络获取内容失败：".$e->getMessage()."<br/>";
		 }
 }
?>