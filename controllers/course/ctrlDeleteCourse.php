<?php 
require_once("../autoload.php");

Session::init();

if(isset($_POST["id_course"])){
	if(isset($_POST["btn_action_delete"])){
		try {
			$enterprise = unserialize(Session::get("enterprise"));
			$course = Course::getSelfFromDatabaseById($_POST["id_course"]);
			if($enterprise->deleteObject($course)){
				header("location: ../../views/course/list.php?deleted=" . $course->getId());
			}
		} catch (Exception $e) {
			echo $e->getMessage();
			exit;
		}
	}else{
		header("location: ../../views/course/list.php");
	}
}

?>