<?php 
ob_start();
	include_once("../layout/header.php");
	include "../../controllers/logout/ctrlLogout.php";
?>
<div class="row" style="width:70%;margin:0 auto">
	<div class="alert alert-success" role="alert">
		<span class="glyphicon glyphicon-ok"></span> <strong>Enhorabona!</strong> Has realitzat el logout amb èxit, t'estem redireccionant a la pàgina de login.
	</div>
</div>

<?php include_once("../layout/footer.php");
header('Refresh:3;URL=../home/login.php');
ob_end_flush();
ob_end_clean();
?>