<?php
  include_once 'lib/BmobObject.class.php';
  include_once 'lib/BmobUser.class.php';
session_start();
 if($_GET){
	 $count =$_GET['count'];
	 $label = $_GET['label'];
	 $where = 'where={"VerifyCode":3}';
	 ($label=="allLabel")?$where: $where='where={"VerifyCode":3,"label":"'.$label.'"}';
	 $num=0;
	 $bmobObj= $results ="";
	 try{
			$bmobObj = new BmobObject("BlogList");
			$res = $bmobObj->get("",array($where));//查询所有通过审核的数据
			$num = count($res->results);//结果集
			$res = $bmobObj->get("",array($where,'limit=8','skip='.($count-1)*8,'order=isTop'));//分页查询通过审核的数据
			$results = $res->results;
			$bmobUser = new BmobUser("_User");//获取每个博主的名字
			echo "日志展示";
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
			$i=1;
			if($num>40){//最多分为5页
				$i=$count;//a标签的下标等于点击的页数
			}
			for(;$i<=$yeshu;$i++){
				echo "<a class='a_page' href='javascript:void(0)' onclick='javascript:curClick(this);'>".$i."</a>";
			}
			echo "<a id='pageDown' href='javascript:void(0)' onclick='javascript:next();'>下一页</a></div>";
	 }catch(Exception $e){
		 echo "网络获取内容失败：".$e->getMessage()."<br/>";
	 } 
 }
?>