<?php 

class Enterprise extends DataObject{

	private $id = null;
	private $name = null;
	private $region = null;
	private $city = null;
	private $users = array();
	private $courses = array();

	//to populate at init session
	private $categories = array();
	//to populate at init session
	private $themes = array();

	public function __construct(){
		parent::__construct($this);
		$this->setUsers(array());
		$this->setCourses(array());
		$this->setCategories(array());
		$this->setThemes(array());
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

	public function getRegion(){
		return $this->region;
	}

	public function setRegion($region){
		$this->region = $region;
	}

	public function getCity(){
		return $this->city;
	}

	public function setCity($city){
		$this->city = $city;
	}

	public function getUsers(){
		return $this->users;
	}

	public function setUsers($users){
		$this->users = $users;
	}

	public function getCourses(){
		return $this->courses;
	}

	public function setCourses($courses){
		$this->courses = $courses;
	}

	public function getCategories(){
		return $this->categories;
	}

	public function setCategories($categories){
		$this->categories = $categories;
	}

	public function getThemes(){
		return $this->themes;
	}

	public function setThemes($themes){
		$this->themes = $themes;
	}

	public function populate(){
		//load info enterprise
		$myself = $this->getSelf(1);
		$this->setId($myself->getId());
		$this->setName($myself->getName());
		$this->setCity($myself->getCity());
		$this->setRegion($myself->getRegion());

		//load all categories (professions)
		$category = new Category();
		$this->setCategories($category->getAll());

		//load all themes (temàtiques)
		$theme = new Theme();
		$this->setThemes($theme->getAll());
	}

	public function addObject($object){
		$added = false;
		if($object->add()){
			$added = true;
		}
		return $added;
	}

	public function deleteObject($object){
		$deleted = false;
		if($object->delete()){
			$deleted = true;
		}
		return $deleted;
	}

	public function updateObject($object){
		$updated = false;
		if($object->update()){
			$updated = true;
		}
		return $updated;
	}

	public function loadDropdownlistThemes($course = null){
		$themes = $this->getThemes();
		echo '<select class="form-control" name="themes" id="themes">';
		foreach ($themes as $theme) {
			$id_theme = $theme->getId();
			$name = strtolower($theme->getName());
			if($course){
				if($id_theme == $course->getTheme()->getId()){
					echo "<option selected value='" . $id_theme . "'>" . ucfirst($name) . "</option>";
				}else{
					echo "<option value='" . $id_theme . "'>" . ucfirst($name) . "</option>";
				}
			}else{
				echo "<option value='" . $id_theme . "'>" . ucfirst($name) . "</option>";
			}
		}
		echo '</select>';
	}

	public function loadDropdownlistCategories($employee = null){
		$categories = $this->getCategories();
      	echo '<select class="form-control" name="categories" id="categories">';
  		foreach ($categories as $category) {
  			$id_category = $category->getId();
			$name = strtolower($category->getName());
			if($employee){
				if($id_category == $employee->getCategory()->getId()){
      				echo "<option selected value='" . $id_category . "'>" . $category->getName() . "</option>";
      			}else{
					echo "<option value='" . $id_category . "'>" . ucfirst($name) . "</option>";
      			}
			}else{
				echo "<option value='" . $id_category . "'>" . ucfirst($name) . "</option>";
			}
   		}	
      	echo '</select>';
	}

	public function loadDropdownlistCourses(){
		$course = new Course();
		$courses = $course->getAll();
      	echo '<select class="form-control" name="courses" id="courses">';
  		foreach ($courses as $course) {
  			$id_course = $course->getId();
			$name = strtolower($course->getName());
			echo "<option value='" . $id_course . "'>" . ucfirst($name) . "</option>";
   		}	
      	echo '</select>';
	}

	public function refresh(){
		$this->populate();
	}
}


?>