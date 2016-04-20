<?php 

require_once("../autoload.php");
require_once("funcValidateFormEmployee.php");

Session::init();

if(isset($_POST["btn_add_course"])){
	$id_course = $_POST["courses"];
	$id_employee = $_POST["id_employee"];
	try {
		$enterprise = unserialize(Session::get("enterprise"));
		$course = Course::getSelfFromDatabaseById($id_course);
		$employee = Employee::getSelfFromDatabaseById($id_employee);
		$enrollment = new Enrollment();
		$enrollment->addRelationEmployeeCourse($employee, $course);
		$enterprise->addObject($enrollment);
		header("Location: ../../views/employee/edit.php?id=" . $id_employee);
	} catch (Exception $e) {
		echo  $e->getMessage();		
	}
}

?>