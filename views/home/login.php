<?php include_once("../layout/header.php");?>
<div id="login-block">
	<h1>Login access</h1>
	<form action="../../controllers/login/ctrlLogin.php" method="post">
		<div>
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required>
		</div>
		<br>
		<div>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
		</div>
		<br>
		<div>
			<label for="code">Captcha:</label>
			<input type="text" id="code" name="code" required>
			<img src="../../controllers/login/ctrlCaptcha.php"><br>
		</div>
		<br>
		<div class="text-center">
			<input type="submit" class="btn btn-primary text-uppercase" value="login">
		</div>
	</form>
</div>
		<?php 
			if(isset($_GET['error'])){ //si hi ha hagut algun error, per part de les validacions.
				$errors = include "../../app/config/errors.inc.php";
				$msnError = $errors[$_GET['error']]; //segons el codi, el missatge es diferent
				echo '<div class="col-md-offset-2 col-md-6 text-center" style="float:none; margin:.5em auto">
						<div class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign"></span> '. $msnError .'</div>
					</div>';
			}
		?>
<?php include_once("../layout/footer.php") ?>