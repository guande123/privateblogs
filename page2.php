<?php
session_start();
header("Content-Type:text/html;Charset=utf-8;");
echo $_SESSION['name']; // 
echo $_SESSION['passwd'];   // 
echo date('Y m d H:i:s', $_SESSION['time']);
echo '<br /><a href="page1.php">返回山一页</a>';
?>