<?php 

class Enrollment extends DataObject{

	private $id = null;
	private $course = null;
	private $employee = null;
	private $improvement = null; //boolean
	private $date = null;

	public function __construct(){
		parent::__construct($this);
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getId(){
		return $this->id;
	}

	public function getCourse(){
		return $this->course;
	}

	public function setCourse($course){
		$this->course = $course;
	}

	public function getEmployee(){
		return $this->employee;
	}

	public function setEmployee($employee){
		$this->employee = $employee;
	}

	public function getImprovement(){
		return $this->improvement;
	}

	public function setImprovement($improvement){
		$this->improvement = $improvement;
	}

	public function getDate(){
		return $this->date;
	}

	public function setDate($date){
		$this->date = $date;
	}

	public function addRelationEmployeeCourse($employee,$course){
		$this->setEmployee($employee);
		$this->setCourse($course);
	}

}


?>