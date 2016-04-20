<?php include_once("../layout/header.php");?>


<h1 class="page-header">New Employee</h1>
<form action="../../controllers/employee/ctrlAddEmployee.php" method="post">
	<div class="form-group row">
	    <label for="name" class="col-md-2 form-control-label">Name</label>
	    <div class="col-md-6">
	      	<input type="text" class="form-control" id="name" name="name" placeholder="Name"required>
	    </div>
	</div>
	<div class="form-group row">
	    <label for="surname" class="col-md-2 form-control-label">Surname</label>
	    <div class="col-md-6">
	      	<input type="text" class="form-control" id="surname" name="surname" placeholder="Surname" required>
	    </div>
	</div>
	<div class="form-group row">
	    <label for="categories" class="col-md-2 form-control-label">Category</label>
	    <div class="col-md-2">
      		<?php 
	      		$enterprise = unserialize(Session::get("enterprise"));
	      		$enterprise->loadDropdownlistCategories();
      		?>
	    </div>
	</div>
	<div class="form-group row">
	    <label for="dni" class="col-md-2 form-control-label">Dni</label>
	    <div class="col-md-6">
	      	<input type="text" class="form-control" id="dni" name="dni" placeholder="Dni" required>
	    </div>
	</div>
	<div class="form-group row">
	    <label for="email" class="col-md-2 form-control-label">Email</label>
	    <div class="col-md-6">
	      	<input type="text" class="form-control" id="email" name="email" placeholder="Email" required>
	    </div>
	</div>
	<div class="form-group row">
	    <div class="col-md-offset-2 col-md-6" style="text-align:right;">
	    	<?php include_once("../../controllers/http/NavigateController.php") ?>
	    	<script src="../../assets/js/alertCancel.js"></script>
	      	<button type="submit" class="btn btn-primary" name="btn_new_employee">Create</button>
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

<?php include_once("../layout/footer.php");?>