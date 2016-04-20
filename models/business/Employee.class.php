<?php 

class Employee extends DataObject{

	private $id = null;
	private $name = null;
	private $surname = null;
	private $category = null;
	private $dni = null;
	private $email = null;

	public function __construct(){
		parent::__construct($this);
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getSurname(){
		return $this->surname;
	}

	public function setSurname($surname){
		$this->surname = $surname;
	}

	public function getCategory(){
		return $this->category;
	}

	public function setCategory($category){
		$this->category = $category;
	}

	public function getDni(){
		return $this->dni;
	}

	public function setDni($dni){
		$this->dni = $dni;
	}

	public function getEmail(){
		return $this->email;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public static function getSelfFromDatabaseById($id){
		$employee = null;
		try {
			$dao = new EmployeeDAO();
			$employee = $dao->get($id);
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $employee;
	}

	public function addRelationCategoryById($idCategory){
		$dao = new CategoryDAO();
		$category = $dao->get($idCategory);
		$this->setCategory($category);
	}

}


?>