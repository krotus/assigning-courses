<?php include_once("../layout/header.php");?>

<div class="row text-right">
	<div class="col-md-11">
		<a class="btn btn-primary" href="new.php"><i class="glyphicon glyphicon-plus"></i> New</a>
	</div>
</div>

<?php 

$mydatagrid =& new CDataGrid(5);
$mydatagrid->toBind("ALL_USERS", 'user');	
$mydatagrid->toRender();

?>

<?php include_once("../layout/footer.php");?>