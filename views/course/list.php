<?php include_once("../layout/header.php");?>

<?php if(isset($_GET['added'])){ ?>
	<div class="row" style="width:70%;margin:0 auto">
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  	<span class="glyphicon glyphicon-ok"></span> Has been added a new course with ID: <?= $_GET['added'] ?>
		</div>
	</div>
<?php } ?>

<?php if(isset($_GET['deleted'])){ ?>
	<div class="row" style="width:70%;margin:0 auto">
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  	<span class="glyphicon glyphicon-ok"></span> Has been deleted the course with old ID: <?= $_GET['deleted'] ?>
		</div>
	</div>
<?php } ?>

<?php if(isset($_GET['updated'])){ ?>
	<div class="row" style="width:70%;margin:0 auto">
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		  	<span class="glyphicon glyphicon-ok"></span> Has been updated successfully the course with ID: <?= $_GET['updated'] ?>
		</div>
	</div>
<?php } ?>

<div class="row text-right">
	<div class="col-md-11">
		<a class="btn btn-primary" href="new.php"><i class="glyphicon glyphicon-plus"></i> New</a>
	</div>
</div>

<?php 

$mydatagrid =& new CDataGrid(5);
$mydatagrid->toBind("ALL_COURSES", 'course');	
$mydatagrid->toRender();

?>

<?php include_once("../layout/footer.php");?>