<?php 
/**
 * Classe amb mètodes estàtics, per validar segons cada cas
 */

class Validate{

	/**
	 * [email Valida si un el correu es válid o no]
	 * @param  [string] $email [Correu electrònic a validar]
	 * @return [boolean]        [Valid true o no false]
	 */
	public static function email($email){
		$valid = false;
		//comprovar que hagi escrit algo
		if(self::emptyField($email)){
			$valid = false;
		//comprovar que es un correu válid 
		}else if(!filter_var($email, FILTER_SANITIZE_EMAIL)){
			$valid = false;
		}else{ //correu válid
			$valid = true;
		}
		return $valid;
	}

	/**
	 * [emailExist Comprova que el correu del empleat existeix ja o no.]
	 * @param  [string] $email     [Correu a evaluar]
	 * @param  [array] $employees [Array d'empleats de l'empresa]
	 * @return [boolean]            [Existeix true, no existeix false]
	 */
	public static function emailExist($email, $employees){
		$exist = false;
		foreach ($employees as $employee) {
			if( strtolower($employee->getEmail()) == strtolower($email) ){
				$exist = true;
			}
		}
		return $exist;
	}

	/**
	 * [emailExist Comprova que el DNI del empleat existeix ja o no.]
	 * @param  [string] $dni     [DNI a evaluar]
	 * @param  [array] $employees [Array d'empleats de l'empresa]
	 * @return [boolean]            [Existeix true, no existeix false]
	 */
	public static function dniExist($dni, $employees){
		$exist = false;
		foreach ($employees as $employee) {
			if( strtolower($employee->getIdCard()) == strtolower($dni) ){
				$exist = true;
			}
		}
		return $exist;
	}

	/**
	 * [minLength Comprova que la cadena tingui la longitud especificada]
	 * @param  [int] $length   [Longitud que ha de tenir de la cadena]
	 * @param  [string] $value [Cadena a evaluar]
	 * @return [boolean]        [Válid true, no válid false]
	 */
	public static function equalsLength($length, $value){
		$valid = true;
		if(strlen($value) != $length){
			$valid = false;
		}else{
			$valid = true;
		}
		return $valid;
	}

	/**
	 * [minLength Comprova que la cadena no sigui inferior de la longitud mínima]
	 * @param  [int] $min   [Longitud mínim de la cadena]
	 * @param  [string] $value [Cadena a evaluar]
	 * @return [boolean]        [Válid true, no válid false]
	 */
	public static function minLength($min, $value){
		$valid = true;
		if(strlen($value) < $min){
			$valid = false;
		}else{
			$valid = true;
		}
		return $valid;
	}	

	/**
	 * [maxLength Comprova que la cadena no sobrepassi de la longitud màxima]
	 * @param  [int] $max   [Longitud màxima de la cadena]
	 * @param  [string] $value [Cadena a evaluar]
	 * @return [boolean]        [Válid true, no válid false]
	 */
	public static function maxLength($max, $value){
		$valid = true;
		if(strlen($value) > $max){
			$valid = false;
		}else{
			$valid = true;
		}
		return $valid;
	}

	/**
	 * [emptyField Comprova que el valor estigui buit]
	 * @param  [string] $value [Valor a evaluar]
	 * @return [boolean]        [Buit true, amb contingut false]
	 */
	public static function emptyField($value){
		$empty = false;
		if(strlen($value) == 0 || is_null($value)){
			$empty = true;
		}else{
			$empty = false;
		}
		return $empty;
	}

	/**
	 * [isNumber Comprova que el valor sigui un número]
	 * @param  [int]  $number [Valor a evaluar]
	 * @return boolean         [Valid com a numero true, no valid false]
	 */
	public static function isNumber($number){
		$valid = false;
		if(is_numeric($number)){
			$valid = true;
		}else{
			$valid = false;
		}
		return $valid;
	}

	/**
	 * [rangeNumber Comprova que el $number estigui entre els rangs mínims i màxims especificats]
	 * @param  [int] $number  [Número a evaluar]
	 * @param  [int] $minRang [Rang mínim que pot pendre el número.]
	 * @param  [int] $maxRang [Rang màxim que pot pendre el número.]
	 * @return [boolean]          [Valid rang true, no valid false]
	 */
	public static function rangeNumber($number, $minRang, $maxRang){
		$valid = false;
		if($number >= $minRang && $number <= $maxRang){
			$valid = true;
		}else{
			$valid = false;
		}
		return $valid;
	}

	/**
	 * [dni Valida si el dni té un format correcte i és valid]
	 * @param  [string] $dni [DNI o NIE a evaluar]
	 * @return [boolean]      [Válid true, no válid false]
	 */
	public static function dni($dni) {
		$valid = true;
		//comprova la longitud i que sigui un format dni
	    if (!self::equalsLength(9, $dni) || preg_match('/^[XYZ]?([0-9]{7,8})([A-Z])$/i', $dni, $matches) !== 1) {
	        $valid = false;

	    }
	    if($valid == true){
	    	$map = 'TRWAGMYFPDXBNJZSQVHLCKE';
	    	list(,$number, $letter) = $matches; //matches a la posició 0 guarda el dni, 1 el numero, 2 la lletra
	    	if(strtoupper($letter) === $map[((int) $number) % 23]){
	    		$valid = true;
	    	}else{
	    		$valid = false;
	    	}	
	    }
	    return $valid;
	}

	/**
	 * [login Valida que el login sigui correcte]
	 * @param  [string] $username [Nom d'usuari que s'introdueix]
	 * @param  [string] $password [Contrasenya del usuari]
	 * @return [booelan]           [True si fa login amb les cradencials correctes, false en cas contrari.]
	 */
	public static function login($username, $password){
		$auth = false;
		if($username == "admin" && $password == "nimda"){
			$auth = true;
		}else{
			$auth = false;
		}
		return $auth;
	}

	/**
	 * [totalCourses Comprova el total de cursos per cada empleat esta inscrit per validar que no sobrepassi el limit permes]
	 * @param  [array] $enrollments [Llista de inscripcions que hi han a l'empresa]
	 * @param  [array] $employees   [Llista de empleats que volen afeguir-se a un curs]
	 * @return [array]              [Llista de empleats que sobrepassen el limit de cursos permesos, buit si no sobrepassen ok]
	 */
	public static function totalCourses($enrollments, $employees){
		//validem les hores que no superin el màxim permés
		$cursosTotals = 0;
		$exceeds = false;
		$employeesExceeded = [];
		for($i = 0; $i < count($employees); $i++){
			$employee = $employees[$i];
			for($j = 0; $j < count($enrollments); $j++){
				if($enrollments[$j]->getEmployee()->getId() == $employee->getId()){
					$cursosTotals++;
					if($cursosTotals == MAX_COURSES_PER_EMPLOYEE){
						$exceeds = true;
						break;
					}
				}
			}
			if($exceeds){
				$employeesExceeded[] = $employee;
			}
			$cursosTotals = 0;
		}
		return $employeesExceeded;
	}
	
	/**
	 * [totalHours Comprova el total de hores per cada empleat que cursa un curs per validar que no sobrepassi el limit permes]
	 * @param  [array] $enrollments [Llista de inscripcions que hi han a l'empresa]
	 * @param  [array] $employees   [Llista de empleats que volen afeguir-se a un curs]
	 * @return [array]              [Llista de empleats que sobrepassen el limit de hores permeses, buit si no sobrepassen ok]
	 */
	public static function totalHours($enrollments, $employees){
		//validem les hores que no superin el màxim permés
		$horesTotals = 0;
		$exceeds = false;
		$employeesExceeded = [];
		for($i = 0; $i < count($employees); $i++){
			$employee = $employees[$i];
			for($j = 0; $j < count($enrollments); $j++){
				if($enrollments[$j]->getEmployee()->getId() == $employee->getId()){
					$course = $enrollments[$j]->getCourse();
					$horesTotals += $course->getHours();
					if($horesTotals >= MAX_HOURS_PER_EMPLOYEE){
						Helper::printVar($horesTotals);
						$exceeds = true;
						break;
					}
				}
			}
			if($exceeds){
				$employeesExceeded[] = $employee;
			}
			$horesTotals = 0;
		}
		return $employeesExceeded;
	}


	public static function dateFormat($date){
		$valid = false;
		// Tallem la cadena de la data per obtenir dia, mes i any
		$year = substr($date, 0, 4);
		$month = substr($date, 5, 2);
		$day = substr($date, 8, 2);

		// Si la data introduïda és correcta
		if (checkdate($month,$day,$year)) {
			$valid = true;
		}

		return $valid;
	}

	public static function dateEqualOrPost($date){
		$valid = false;
		// Tallem la cadena de la data per obtenir dia, mes i any
		$year = substr($date, 0, 4);
		$month = substr($date, 5, 2);
		$day = substr($date, 8, 2);
		
		// Si la data introduïda és major o igual a la del sistema
		if((($year*10000)+($month*100)+$day) >= date("Ymd")) {
        	$valid = true;
		}

		return $valid;
	}

}

?>