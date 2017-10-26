<?php
  include_once '../lib/BmobObject.class.php';
  include_once '../lib/BmobUser.class.php';
	session_start();
	 $num=0;
	 $bmobObj= $results ="";
	 $bmobObj= new BmobObject("_User");
	 if(isset($_GET['hide'])){
		 if($_GET['hide']==0){
			 $bmobObj->update($_GET['id'],array("hide"=>false)); 
		 }else{
			  $bmobObj->update($_GET['id'],array("hide"=>true)); 
		 }
	 }
	 try{
		 $res=$bmobObj->get("",array('where={"isManager":false}','limit=8','skip='.$_GET['count']*8));
		 $results = $res->results ;		
		 $num = count($results);
		 if($num>0){
			echo "<table id='c_table'>";
			echo "<tr>";
			echo "<td><b>用户</b></td>";
			echo "<td><b>状态</b></td>";
			echo "</tr>";
			$bmobObj= new BmobObject("_User");			 
			for($i=0;$i<$num;$i++){
				$col =  $results[$i];
				echo "<tr>";
				echo "<td>".$col->username."</td>";
				if(isset($col->hide)){
					if($col->hide){
					echo "<td><a href='javascript:void(0);' onclick='hideOrShow(0,\"$col->objectId\")'>恢复</a></td>";	
					}else{
							echo "<td><a href='javascript:void(0);' onclick='hideOrShow(1,\"$col->objectId\")'>拉黑</a></td>";
					}
				}else{
					echo "<td><a href='javascript:void(0);' onclick='hideOrShow(1,\"$col->objectId\")'>拉黑</a></td>";
				}
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