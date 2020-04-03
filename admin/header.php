<?php
ob_start();
spl_autoload_register(function($classes){
  require_once('class/'. $classes .'.php');

  });
  if(!isset($_COOKIE['name'])){
    header('location:login.php');
  }
$url = $_SERVER['PHP_SELF'];
$url = explode('/',$url);



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Sujon Kumar Shil
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <!--  costom css-->
  <link rel ="stylesheet" type="text/css" href="custom.css">
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo"><a href="" class="simple-text logo-normal">
          w3csoft
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item  <?=end($url)=='index.php'?'active':''?>">
            <a class="nav-link" href="index.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?=end($url)=='add-user.php'?'active':''?> ">
            <a class="nav-link" href="add-user.php">
              <i class="material-icons">person</i>
              <p>Add User</p>
            </a>
          </li>
          <li class="nav-item <?=end($url)=='post.php'?'active':''?>">
            <a class="nav-link" href="post.php">
              <i class="material-icons">shop</i>
              <p>Add Product</p>
            </a>
          </li>
		  <li class="nav-item <?=end($url)=='post.php'?'active':''?>">
            <a class="nav-link" href="add_offer.php">
              <i class="material-icons">add_circle</i>
              <p>Add Offer</p>
            </a>
          </li>
          <li class="nav-item <?=end($url)=='logout.php'?'active':''?>">
            <a class="nav-link" href="logout.php">
              <i class="material-icons">logout</i>
              <p>Log out</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
