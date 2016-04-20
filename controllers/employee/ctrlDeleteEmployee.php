<?php 
require_once("../autoload.php");

Session::init();

if(isset($_POST["id_employee"])){
	if(isset($_POST["btn_action_delete"])){
		try {
			$enterprise = unserialize(Session::get("enterprise"));
			$employee = Employee::getSelfFromDatabaseById($_POST["id_employee"]);
			if($enterprise->deleteObject($employee)){
				header("location: ../../views/employee/list.php?deleted=" . $employee->getId());
			}
		} catch (Exception $e) {
			echo $e->getMessage();
			exit;
		}
	}else{
		header("location: ../../views/employee/list.php");
	}
}

?>