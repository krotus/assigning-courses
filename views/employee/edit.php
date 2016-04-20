<?php include_once("../layout/header.php");?>

<?php 
	$employee = Employee::getSelfFromDatabaseById($_GET["id"]);
?>

<style>	#add_course_to_employee{display: none;} </style>

<h1 class="page-header">Edit Employee</h1>
<form action="../../controllers/employee/ctrlEditEmployee.php" method="post">
	<input type="hidden" name="id_employee" id="id_employee" value="<?= $_GET["id"] ?>">
	<div class="form-group row">
	    <label for="name" class="col-md-2 form-control-label">Name</label>
	    <div class="col-md-6">
	      	<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="<?= $employee->getName() ?>" required>
	    </div>
	</div>
	<div class="form-group row">
	    <label for="surname" class="col-md-2 form-control-label">Surname</label>
	    <div class="col-md-6">
	      	<input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" value="<?= $employee->getSurname() ?>" required>
	    </div>
	</div>
	<div class="form-group row">
	    <label for="categories" class="col-md-2 form-control-label">Category</label>
	    <div class="col-md-2">
			<?php 
	      		$enterprise = unserialize(Session::get("enterprise"));
	      		$enterprise->loadDropdownlistCategories($employee);
      		?>
	    </div>
	</div>
	<div class="form-group row">
	    <label for="dni" class="col-md-2 form-control-label">Dni</label>
	    <div class="col-md-6">
	      	<input type="text" class="form-control" id="dni" name="dni" placeholder="Dni" value="<?= $employee->getDni() ?>" required>
	    </div>
	</div>
	<div class="form-group row">
	    <label for="email" class="col-md-2 form-control-label">Email</label>
	    <div class="col-md-6">
	      	<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $employee->getEmail() ?>" required>
	    </div>
	</div>
	<div class="form-group row">
	    <div class="col-md-offset-2 col-md-6" style="text-align:right;">
	      	<?php include_once("../../controllers/http/NavigateController.php") ?>
	    	<script src="../../assets/js/alertCancel.js"></script>
	      	<button type="submit" class="btn btn-primary" name="btn_edit_employee">Edit</button>
	    </div>
	</div>
	<div class="row text-right">
		<div class="col-md-11">
	      	<a id="btn_add_course_to_employee" class="btn btn-primary">Add Course</a>
		</div>
	</div>
	<?php 
		if(isset($_GET['error'])){ //si hi ha hagut algun error, per part de les validacions.
			$errors = include "../../app/config/errors.inc.php";
			$msnError = $errors[$_GET['error']]; //segons el codi, el missatge es diferent
			echo '<div class="col-md-offset-2 col-md-6">
					<div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> '. $msnError .'</div>
				</div>';
		}
	?>

</form>
<div style="text-align:center;padding-bottom: 60px;">
	<form id="add_course_to_employee" name="add_course_to_employee" action="../../controllers/employee/ctrlEnrollment.php" method="post">
		<input type="hidden" name="id_employee" id="id_employee" value="<?= $_GET["id"] ?>">
		<h2 class="page-header">Add a Course</h2>
		<div class="form-group">
		    <label for="courses" class="col-md-4 form-control-label">Courses</label>
		    <div class="col-md-4">
		      	<?php 
		      		$enterprise->loadDropdownlistCourses();
		      	?>
		    </div>
		</div>	
      	<div class="col-md-4">
      	  	<button type="submit" class="btn btn-primary" name="btn_add_course">Add</button>
      	</div>
	</form>
</div>
	<?php 

		$mydatagrid =& new CDataGrid(5);
		$cad = "SELECT courses.id as 'Id course', courses.name as Name, 
				courses.hours as Hours, courses.start_date FROM course_employee 
				INNER JOIN courses ON course_employee.id_course = courses.id 
				WHERE id_employee = " . $employee->getId();
		$mydatagrid->toBindRows($cad, 'employee');	
		$mydatagrid->toRender();
	?>

<script>
	$(document).ready(function(){
		var control = 0;
		$("#btn_add_course_to_employee").on("click", function(){
			if(control == 0){
				$("#btn_add_course_to_employee").html("Cancel");
				control = 1;
			}else{
				$("#btn_add_course_to_employee").html("Add Course");
				control = 0;
			}
			$("#add_course_to_employee").fadeToggle( "fast");
		});
	});

</script>

<?php include_once("../layout/footer.php");?>