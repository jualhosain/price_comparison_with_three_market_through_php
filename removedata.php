<?php
     session_start();
    $id = $_REQUEST['price_id'];


   if(isset($_SESSION['array'])){
    $array = $_SESSION['array'];
    $removeKey= array_search($id,$array);
    array_splice($array, 0,1);
    $_SESSION['array']= $array;
    if(!isset($_SESSION['array'])){
        header('location: index.php');
      }
   }

?>