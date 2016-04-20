<?php 

/**
 * Classe Session de mètodes estatic, per controlar les sessions dintre de l'aplicació
 * */
Class Session{

	/**
	 * [init Obrim pas a les variables de sessió]
	 * @return [void] [No retorna res]
	 */
	public static function init(){
		session_start();
	}

	/**
	 * [destroy Elimina totes les claus de sessió si no es pasa parametre especificant una en concret ]
	 * @param  [string] $key [El nom de sessió en clau a eliminar (opcional)]
	 * @return [void]       [No retorna res]
	 */
	public static function destroy($key = false){
		if($key){
			if(is_array($key)){
				for($i = 0; $i < count($key); $i++){
                    if(isset($_SESSION[$key[$i]])){
                        unset($_SESSION[$key[$i]]);
                    }
                }
			}else{
				if(isset($_SESSION[$key])){
                    unset($_SESSION[$key]);
                }
			}
		}else{
			session_destroy();
		}
	}

	/**
	 * [set Modifica el valor que tenia anteriorment una variable de sessió]
	 * @param [string] $key   [El nom de sessió en clau]
	 * @param [string] $value [El nou valor per la sessió]
	 */
	public static function set($key, $value){
		if(!empty($value)){
			$_SESSION[$key] = $value;
		}
	}

	/**
	 * [get S'obte una sessió en concret]
	 * @param  [string] $key [El nom de sessió en clau a obtenir]
	 * @return [object]      [Una objecte sessió]
	 */
	public static function get($key){
		if(isset($_SESSION[$key])){
		    return $_SESSION[$key];
		}
	}

	public static function accessView(){
		if(!Session::get('admin')){
			header('location: ../login/login.php?error=109&input=header');
			exit;
		}
	}

	public static function logged(){
		if(!Session::get('admin')){
			return false;
		}else{
			return true;
		}
	}

}

?>