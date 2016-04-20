<?php include_once("../layout/header.php");?>

<!-- main calendar program -->
<script type="text/javascript" src="../../assets/js/jscalendar/calendar.js"></script>

<!-- language for the calendar -->
<script type="text/javascript" src="../../assets/js/jscalendar/lang/calendar-en.js"></script>

<!-- the following script defines the Calendar.setup helper function, which makes
     adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="../../assets/js/jscalendar/calendar-setup.js"></script> 

<h1 class="page-header">New Course</h1>
<form action="../../controllers/course/ctrlAddCourse.php" method="post">
	<div class="form-group row">
	    <label for="name" class="col-md-2 form-control-label">Name</label>
	    <div class="col-md-6">
	      	<input type="text" class="form-control" id="name" name="name" placeholder="Name" value="" required>
	    </div>
	</div>
	<div class="form-group row">
	    <label for="themes" class="col-md-2 form-control-label">Theme</label>
	    <div class="col-md-2">
      		<?php 
	      		$enterprise = unserialize(Session::get("enterprise"));
	      		$enterprise->loadDropdownlistThemes();
      		?>
	    </div>
	</div>
	<div class="form-group row">
	    <label for="hours" class="col-md-2 form-control-label">Hours</label>
	    <div class="col-md-6">
	      	<input type="number" class="form-control" id="hours" name="hours" placeholder="Hours lasting" value="" required>
	    </div>
	</div>
	<div class="form-group row">
	    <label for="start_date" class="col-md-2 form-control-label">Start Date</label>
	    <div class="col-md-2">
			<input type="text" class="form-control" name="start_date" id="start_date" required> 
	    </div>
		<button type="reset" id="btnSelectDate" class="glyphicon glyphicon-calendar btn btn-default"></button>
	</div>
	<div class="form-group row">
	    <div class="col-md-offset-2 col-md-6" style="text-align:right;">
	    	<?php include_once("../../controllers/http/NavigateController.php") ?>
	    	<script src="../../assets/js/alertCancel.js"></script>
	      	<button type="submit" class="btn btn-primary" name="btn_new_course">Create</button>
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
<script type="text/javascript">
	Calendar.setup({
	    inputField     :    "start_date",      // id of the input field
	    ifFormat       :    "%Y-%m-%d",   // format of the input field
	    showsTime      :    false,         // will display a time selector
	    button         :    "btnSelectDate",      // trigger for the calendar (button ID)
	    singleClick    :    false,        // double-click mode
	    step           :    1             // show all years in drop-down boxes (instead of every other year as default)
	});
</script>

<?php include_once("../layout/footer.php");?>