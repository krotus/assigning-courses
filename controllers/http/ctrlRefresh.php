<?php 
	require_once("../autoload.php");
	Session::init();
	$enterprise = unserialize(Session::get('enterprise'));
	$enterprise->refresh();
	header("Location: " . $_SERVER["HTTP_REFERER"]);
?>