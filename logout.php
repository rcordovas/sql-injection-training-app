<?php
if (!isset($_SESSION['username'])) {
   header("location:index.php");
   exit();
}else{ //cancel the session
   $_SESSION = array(); // Destroy the variables
   session_destroy(); // Destroy the session
   setcookie('PHPSESSID', ", time()-3600,'/', ", 0, 0);//Destroy the cookie
   header("location:index.php");
   exit();
}
session_set_cookie_params(0);
header('Location:index.php');
?>