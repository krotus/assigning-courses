<?php 

	require_once("../autoload.php");
	Session::init();

	if(isset($_POST['code'])){
		$error = 0;
		if($_POST['code'] == Session::get('captcha')){
			$result = "Valid";
			$user = new User();
			$user->setUsername($_POST['username']);
			$user->setPassword($_POST['password']);
			if($user->validateCredentials()){
				//ALL OK
			}else{
				$error = 108;
			}
		}else{
			$error = 116;
		}

		if($error == 0){
			Session::set("admin", serialize($user));
			$enterprise = new Enterprise();
			$enterprise->populate();
			Session::set("enterprise", serialize($enterprise));
			//Session::set('admin',true);
			header("location: ../../views/home/dashboard.php");
		}else{
			$fromUrl = $_SERVER["HTTP_REFERER"];//guardem la url (on es troba el form d'entrada)
			if(strpos($fromUrl, '?')){ // si ja veniem d'un error abans i hi sorgeix un segon
				$fromUrl = explode("?", $fromUrl)[0];
			}
			header("location: " . $fromUrl . "?error=" . $error );
		}
	}

?>