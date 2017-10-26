<?php
  include_once 'lib/BmobObject.class.php';
  include_once 'lib/BmobUser.class.php';
session_start();
 if($_GET){
	  $count  =$_GET['count'];
	  $label="";
	  $where = 'where={"VerifyCode":3}';
      $_SESSION['yeshu_start'] = $count+1;
	  if(isset($_GET['label'])){
		  	  $label  =$_GET['label'];
			 ($label=="allLabel")?$where: $where='where={"VerifyCode":3,"label":"'.$label.'"}';
	 }


	//  echo "count:".$count;debug
	  $per_page_total = 8;
	  $bmobObject = new BmobObject('BlogList');

	  if(isset($_GET['myblogs'])){
		 $where = 'where={"user_id":"'.$_SESSION['res']->objectId.'","VerifyCode":3}'; 
	  }
	  $res=$bmobObject->get("",array($where,'order=isTop'));
	  $results = $res->results ;		//查询到BlogList表中的所有行
	  $response = "<p>已通过审核的博文</p><table id='c_table'><tr><td><b>博主</b></td><td><b>标题</b></td><td><b>时间</b></td></tr>";
	  $num = count($results);
	  $bmobObj= new BmobObject("_User");			
	  if($num>0){
	  $i= $count*$per_page_total;
	  $e=$i+8;
	  ($e>$num)?$e=$num:$e;

      for(;$i<$e;$i++){
		  	$col =  $results[$i];
			$res=$bmobObj->get($col->user_id);
			if(isset($col->isTop)&&$col->isTop==0){
			$response=$response."<td>".$res->username."   置顶</td>";	
			}else{
			$response=$response."<td>".$res->username."</td>";	
			}
			$response=$response."<td><a href='blogsarea/blogsInfo.php?user_id=$col->user_id&blog_id=$col->objectId'>".$col->title."</a></td><td>".$col ->createdAt."</td></tr>";
		}
		$yeshu=1;
		 $shang = floor($num/8);
		($num%8!=0)?($yeshu=$shang+1):($yeshu=$shang);
		($yeshu<5)?$yeshu:($yeshu=5);
		$response=$response."</table><div class='page_div'><a id='pageUp' href='javascript:void(0)' onclick='javascript:preview();'>上一页</a>";
		for($i=0;$i<$yeshu;$i++){
		$response=$response."<a class='a_page' href='javascript:void(0)' onclick='javascript:curClick(this);'>".($count+1)."</a>";
		 $count++;
		}
		$response=$response. '<a id="pageDown" href="javascript:void(0)"  onclick="javascript:next();">下一页</a><span>共'.$num.'条</span></div>';				
	  }else{
		$response = "还没任何博主发表博文！";
	  }
	  echo $response;
 }
?>