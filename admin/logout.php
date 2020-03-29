<?php
 
 if(isset($_COOKIE['name'])){
    setcookie('name',$cookie_value,time()-500);
    header('location:login.php');
 }

?>