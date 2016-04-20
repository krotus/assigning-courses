<?php 

class Theme extends DataObject{

	private $id = null;
	private $name = null;
	private $courses = array();
	private $category = null;

	public function __construct(){
		parent::__construct($this);
		$this->setCourses(array());
	}


	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}
	
	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getCourses(){
		return $this->courses;
	}

	public function setCourses($courses){
		$this->courses = $courses;
	}

	public function getCategory(){
		return $this->category;
	}

	public function setCategory($category){
		$this->category = $category;
	}

	public static function getAllFromDatabase(){
		$themes = null;
		try {
			$dao = new ThemeDAO();
			$themes = $dao->getAll();
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $themes;
	}

}

?>