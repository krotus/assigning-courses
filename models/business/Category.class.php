<?php 

class Category extends DataObject{

	private $id = null;
	private $name = null;
	private $costHour = null;
	private $employees = array();
	private $themes = array();


	public function __construct(){
		parent::__construct($this);
		$this->setEmployees(array());
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

	public function getCostHour(){
		return $this->costHour;
	}

	public function setCostHour($costHour){
		$this->costHour = $costHour;
	}

	public function getEmployees(){
		return $this->employee;
	}

	public function setEmployees($employees){
		$this->employees = $employees;
	}

	public function getThemes(){
		return $this->themes;
	}

	public function setThemes($themes){
		$this->themes = $themes;
	}

	public static function getAllFromDatabase(){
		$categories = null;
		try {
			$dao = new CategoryDAO();
			$categories = $dao->getAll();
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $categories;
	}


}

?>