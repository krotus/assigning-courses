<?php 

require_once("../autoload.php");
require_once("funcValidateFormCourse.php");

if(isset($_POST["btn_new_course"])){
	/* Validacions */
	$error = validateFormCourse($_POST["name"],$_POST["hours"],$_POST["start_date"]);
	if($error == 0){
		$course = new Course();
		
		$course->setName($_POST["name"]);
		
		$course->setHours($_POST["hours"]);
		
		$mysqltime = date("Y-m-d", strtotime($_POST["start_date"]));
		$course->setStartDate($mysqltime);
		try {
			$course->addRelationThemeById($_POST["themes"]);
			if($course->add()){
				header("location: ../../views/course/list.php?added=" . $course->getId());
			}
		} catch (Exception $e) {
			echo $e->getMessage();		
		}
	}else{
		$fromUrl = $_SERVER["HTTP_REFERER"];//guardem la url (on es troba el form d'entrada)
		if(strpos($fromUrl, '?')){ // si ja veniem d'un error abans i hi sorgeix un segon
			$fromUrl = explode("?", $fromUrl)[0];
		}
		header("location: " . $fromUrl . "?error=" . $error );
	}
}

?>