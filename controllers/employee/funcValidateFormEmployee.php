<?php 

require_once("../autoload.php");
require_once("../../app/config/config.inc.php");

function validateFormEmployee($namePost, $surnamePost, $dniPost, $emailPost){
	$error = 0;
	//nom
	if(isset($namePost)){
		$name = $namePost;
		if(!Validate::emptyField($name)){
			if(Validate::minLength(3,$name)){
				//surname
				if(isset($surnamePost)){
					$surname = $surnamePost;
					if(!Validate::emptyField($surname)){
						//dni
						if(isset($dniPost)){
							$dni = $dniPost;
							if(!Validate::emptyField($dni)){
								if(Validate::dni($dni)){
									//email
									if(isset($emailPost)){
										$email = $emailPost;
										if(!Validate::emptyField($email)){
											//ALL OK
										}else{
											//email està buit
											$error = 100;
										}
									}
								}else{
									//dni no valid
									$error = 105;
								}
							}else{
								//dni està buit
								$error = 100;
							}
						}
					}else{
						//hours està buit
						$error = 100;
					}
				}	
			}else{
				//nom no te un minim de caracters
				$error = 101;
			}
		}else{
			//nom està buit
			$error = 100;
		}
	}

	return $error;
}

?>