<?php
  include_once '../lib/BmobObject.class.php';
  include_once '../lib/BmobUser.class.php';
  if($_GET){
       $agree = $_GET['isAgree'];
	   $id = $_GET['id'];
	   $res;
	   $bmobObj = new BmobObject('BlogList');
	   if($agree==0){
		 $res =  $bmobObj->update($id,array("VerifyCode"=>3));  
	   }else if($agree ==1){
		   $reason = $_GET['reason'];
		  $res=$bmobObj->update($id,array("VerifyCode"=>2,"rejectReason"=>$reason)); //删除对象bd89c6bce9	  
	   }
	//  var_dump($res);
	 try{
	   $res =  $bmobObj->get("",array('where={"VerifyCode":1}','limit = 8','skip = 0'));//分页查询，skip为查询的起点
	   $results = $res->results ;		
	   $num = count($results);
	   if($num>0){
				echo "<table id='c_table'>";
				echo "<tr>";
				echo "<td><b>博主</b></td>";
				echo "<td><b>标题</b></td>";
				echo "<td><b>时间</b></td>";
				echo "</tr>";
				$bmobObj= new BmobObject("_User");			 
				for($i=0;$i<$num;$i++){
					$col =  $results[$i];
					$res=$bmobObj->get($col->user_id);
					echo "<tr>";
					echo "<td>".$res->username."</td>";
					echo "<td><a href='blogsarea/blogsInfo.php?user_id=$col->user_id&blog_id=$col->objectId&createdAt=$col->createdAt&name=$res->username&title=$col->title'>".$col->title."</a></td>";
					echo "<td>".$col->createdAt."</td>";
					echo "<td><a href='javascript:void(0)' onclick='isAgree(0,\"$col->objectId\")'>同意</a></td>";
					echo "<td><a href='javascript:void(0)' onclick='isAgree(1,\"$col->objectId\")'>拒绝</a></td>";
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
			 echo "~".$num; 
		 }catch(Exception $e){
			 echo "网络获取内容失败：".$e->getMessage()."<br/>";
		 }
 }
?>