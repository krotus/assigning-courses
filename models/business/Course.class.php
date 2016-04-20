<?php 



class Course extends DataObject{

	private $id = null;
	private $name = null;
	private $hours = null;
	private $startDate = null;
	private $theme = null;
	private $courseEmployee = array();

	public function __construct(){
		parent::__construct($this);
		$this->setCourseEmployee(array());
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

	public function getHours(){
		return $this->hours;
	}

	public function setHours($hours){
		$this->hours = $hours;
	}

	public function getStartDate(){
		return $this->startDate;
	}

	public function setStartDate($startDate){
		$this->startDate = $startDate;
	}

	public function getTheme(){
		return $this->theme;
	}

	public function setTheme($theme){
		$this->theme = $theme;
	}

	public function getCourseEmployee(){
		return $this->courseEmployee;
	}

	public function setCourseEmployee($courseEmployee){
		$this->courseEmployee = $courseEmployee;
	}

	public static function getSelfFromDatabaseById($id){
		$course = null;
		try {
			$dao = new CourseDAO();
			$course = $dao->get($id);
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $course;
	}

	public function addRelationThemeById($idTheme){
		$dao = new ThemeDAO();
		$theme = $dao->get($idTheme);
		$this->setTheme($theme);
	}

	public static function getAllFromDatabase(){
		$courses = null;
		try {
			$dao = new CourseDAO();
			$courses = $dao->getAll();
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $courses;
	}


}

?>