<?php

spl_autoload_register(function($classes){
    require_once('class/'. $classes .'.php');
  
    });
    $admin = new Admin();
   if(isset($_REQUEST['postId'])){
    $postid =$_REQUEST['postId'];
    $sql = "DELETE FROM `post` WHERE post_id = $postid";
    $deletePost = $admin->deletePost($sql);
   }
   if(isset($_REQUEST['userId'])){
    $userid =$_REQUEST['userId'];
    $sql = "DELETE FROM `user` WHERE id = $userid";
    $deletePost = $admin->deletePost($sql);
   }

?>