<?php 

require_once("../autoload.php");
require_once("funcValidateFormEmployee.php");
Session::init();

if(isset($_POST["btn_new_employee"])){
	/* Validacions */
	$error = validateFormEmployee($_POST["name"],$_POST["surname"],$_POST["dni"], $_POST["email"]);
	if($error == 0){
		try {
			$employee = new Employee();
			
			$employee->setName($_POST["name"]);
			$employee->setSurname($_POST["surname"]);
			$employee->setDni($_POST["dni"]);
			$employee->setEmail($_POST["email"]);
			$employee->addRelationCategoryById($_POST["categories"]);

			$enterprise = unserialize(Session::get("enterprise"));
			$enterprise->addObject($employee);
			header("location: ../../views/employee/list.php?added=" . $employee->getId());
		} catch (Exception $e) {
			echo $e->getMessage();
			exit;	
		}
	}else{
		$fromUrl = $_SERVER["HTTP_REFERER"];//guardem la url (on es troba el form d'entrada)
		if(strpos($fromUrl, '?')){ // si ja veniem d'un error abans i hi sorgeix un segon
			$fromUrl = explode("?", $fromUrl)[0];
		}
		header("location: " . $fromUrl . "?error=" . $error );
	}
}else{
	header("location: ../../views/employee/list.php");
}

?>