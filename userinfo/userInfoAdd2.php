<?php
  include_once '../lib/BmobObject.class.php';
  include_once '../lib/BmobUser.class.php';
session_start();
 if($_GET){
	  $nickname = $_GET['nickname'];
	  $address = $_GET['place'];
	  $gender = $_GET['maleChecked'];
	  $birthday = $_GET['time'];
	  $void = $_GET['textarea'];
	  $bmobObject = new BmobObject('User_info');
	  $res=$bmobObject->get("",array('where={}'));
	  $results = $res->results ;		//查询到User_info表中的所有行
	  $num = count($results);
	  $arr = array("nickname"=>$nickname,"address"=>$address,"user_id"=>$_SESSION['res']->objectId,
	      "birthday"=>$birthday,"void"=>$void,"gender"=>$gender);
	  if($num>0){		 
		 for($i=0;$i<$num;$i++){
			$col =  $results[$i];//User_info表的每一行
			if($_SESSION['res']->objectId == $col->user_id){//判断是否当前用户
		    //更新数据
			 $arr =  array("nickname"=>$nickname,"address"=>$address,
	      "birthday"=>$birthday,"void"=>$void,"gender"=>$gender);
			 $res = $bmobObject->update($col->objectId,$arr );
			 var_dump($res);
			 break;
		   }else{
		  //添加数据
		    $res= $bmobObject->create($arr );
	        var_dump($res);
              break;		
			}
		 }
	 
		}else{
			$res= $bmobObject->create($arr );
	        var_dump($res);
		 }
		 echo "OK";	
 }
?>