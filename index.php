<?php 
require_once("controllers/autoload.php");
Session::init();
if(Session::get("admin") == null){
	header("location: views/home/login.php");
}else{
	header("location: views/home/dashboard.php");
}

?>