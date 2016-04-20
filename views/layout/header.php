<?php 
  include_once("../../app/config/config.inc.php"); 
  require_once("../../controllers/autoload.php");
  Session::init();
  if(Session::get("admin") == null){
    if(strpos($_SERVER['PHP_SELF'], "login") <= 0){ //avoid infinite loop
      header("location: ../home/login.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME ?></title>
    <!-- jquery del CDN de google -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- javascript del sweetalert -->
    <script src="../../assets/sweetalert/sweetalert.min.js"></script>
    <script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- boostrap css -->
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- sweetalert css -->
    <link rel="stylesheet" type="text/css" href="../../assets/sweetalert/sweetalert.css">
    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="../../assets/css/base.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/tables.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/comentaris.css">
  </head>
  <body>
  <div class="container-fluid">
    <!-- Static navbar -->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../home/dashboard.php"><i class="glyphicon glyphicon-education"></i><?= APP_NAME ?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="../home/dashboard.php">Dashboard</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Courses <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../course/list.php">List</a></li>
                <li><a href="../course/new.php">Add New</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Themes <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../theme/list.php">List</a></li>
                <li><a href="../theme/new.php">Add New</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Employees <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../employee/list.php">List</a></li>
                <li><a href="../employee/new.php">Add New</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Users <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../user/list.php">List</a></li>
                <li><a href="../user/new.php">Add New</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="../category/list.php">List</a></li>
                <li><a href="../category/new.php">Add New</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php
              if(Session::logged()){
                $user = unserialize(Session::get("admin"));
                echo "<li><a href='../../controllers/http/ctrlRefresh.php'>Refresh <span style='color:#90ee90' class='glyphicon glyphicon-refresh'></span></a></li>";
                echo "<li><a>You are <span style='color:lightblue'>" . $user->getUsername() . "</span></a></li>";
                echo "<li><a href='../home/logout.php'><i style='color:crimson' class='glyphicon glyphicon-off'></i> Logout</a></li>";
              }else{
                echo "<li><a href='../home/login.php'><i style='color:lightblue' class='glyphicon glyphicon-log-in'></i> Login</a></li>";
              }
            ?>
          </ul>
        </div><!--/.nav-collapse -->
    </nav>
    <div class="jumbotron">