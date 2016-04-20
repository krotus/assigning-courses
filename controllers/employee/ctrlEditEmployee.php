<?php 

require_once("../autoload.php");
require_once("funcValidateFormEmployee.php");

if(isset($_POST["btn_edit_employee"])){
	/* Validacions */
	$error = validateFormEmployee($_POST["name"],$_POST["surname"],$_POST["dni"], $_POST["email"]);
	if($error == 0){
		$employee = new Employee();
		
		$id_employee = $_POST["id_employee"];
		$employee->setId($id_employee);
		$employee->setName($_POST["name"]);
		$employee->setSurname($_POST["surname"]);
		$employee->setDni($_POST["dni"]);
		$employee->setEmail($_POST["email"]);
		try {
			$employee->addRelationCategoryById($_POST["categories"]);
			if($employee->update()){
				header("location: ../../views/employee/list.php?updated=" . $employee->getId());
			}
		} catch (Exception $e) {
			echo $e->getMessage();		
		}
	}else{
		$fromUrl = $_SERVER["HTTP_REFERER"];//guardem la url (on es troba el form d'entrada)
		if(strpos($fromUrl, '?')){ // si ja veniem d'un error abans i hi sorgeix un segon
			$fromUrl = explode("?", $fromUrl)[0];
		}
		header("location: " . $fromUrl . "?error=" . $error . "&id=" . $_POST["id_course"]);
	}
}else{
	header("location: ../../views/employee/list.php");
}

?>