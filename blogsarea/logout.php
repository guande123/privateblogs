<?php 
   session_start();
   unset($SESSION['res']);
   session_destroy();
   header("location:../main.php");
?>