<?php 


class User extends DataObject{

	private $id = null;
	private $username = null;
	private $password = null;


	public function __construct(){
		parent::__construct($this);
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getUsername(){
		return $this->username;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function getPassword(){
		return $this->password;
	}

	public function setPassword($password){
		if(strlen($password) == 40){ //is a password sha1
			$this->password = $password;
		}else{
			$this->password = sha1($password);
		}
	}

	public function validateCredentials(){
		$userDAO = new UserDAO();
		$users = $userDAO->getAll();
		$valid = false;
		if(!empty($users)){
			foreach ($users as $user) {
				if($this->getUsername() == $user->getUsername() && $this->getPassword() == $user->getPassword()){
					$valid = true;
					break;
				}
			}
		}
		return $valid;
	}

	public function getSelfByUsername($name){
		$object = null;
		try {
			$stringToEval = "new ". $this->typeObject . "DAO();";
			eval("\$dao = $stringToEval");
			$object = $dao->getByUsername($name);
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $object;	
	}

}

?>