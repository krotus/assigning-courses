<?php 

require_once("../autoload.php");
require_once("../../app/config/config.inc.php");

function validateFormCourse($namePost, $hoursPost, $start_datePost){
	$error = 0;
	//nom
	if(isset($namePost)){
		$name = $namePost;
		if(!Validate::emptyField($name)){
			if(Validate::minLength(3,$name)){
				//hores
				if(isset($hoursPost)){
					$hours = $hoursPost;
					if(!Validate::emptyField($hours)){
						if(Validate::isNumber($hours)){
							if(Validate::rangeNumber($hours,1,MAX_HOURS_PER_COURSE)){
								//calendari
								if(isset($start_datePost)){
									$start_date = $start_datePost;
									if(!Validate::emptyField($start_date)){
										if(Validate::dateFormat($start_date)){
											if(Validate::dateEqualOrPost($start_date)){
												//All OK
											}else{
												//start_date la data a de ser igual o posterior a la del sistema
												$error = 115;
											}
										}else{
											//start_date format no vàlid
											$error = 114;
										}
									}else{
										//start_date està buit
										$error = 100;
									}
								}
							}else{
								//la duració es troba fora del rang permés (100hores)
								$error = 111;
							}
						}else{
							//la duració no és númerica
							$error = 110;
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