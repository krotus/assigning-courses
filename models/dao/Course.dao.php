<?php 

require_once "models/business/DAO.interface.php";
require_once "app/core/exceptions/DAOException.php";
class CourseDAO implements DAO{

	public $db;

	public function __construct(){
		try {
			$this->db = new Database();
			if($this->db == null){
				throw new SQLException("There was an error with the instantiation of the database", 4);
			}
		} catch (SQLException $e) {
			echo $e->getErrorMessage();
		}
	}

	public function get($id){
		$query = "SELECT * FROM courses WHERE id = :id";
		$course = null;
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(':id' => $id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row){
				$course = new Course();
				$course->setId($row["id"]);	
				$course->setName($row["name"]);
				$course->setHours($row["hours"]);
				$course->setStartDate($row["start_date"]);
				$daoTheme = new ThemeDAO();
				$theme = $daoTheme->get($row["id_theme"]);
				$course->setTheme($theme);
			}else{
				throw new DAOException("There is no course with the id equals to " . $id, 0);
			}
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $course;
	}

	//retorna la id
	public function insert($course){
		$sql = "INSERT INTO courses (name,hours,start_date,id_theme,id_enterprise) VALUES 
									(:name,:hours,:start_date,:id_theme,:id_enterprise)";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":name", $course->getName() ,PDO::PARAM_STR);
		$stmt->bindParam(":hours", $course->getHours() ,PDO::PARAM_INT);
		$stmt->bindParam(":start_date", $course->getStartDate() ,PDO::PARAM_STR);
		$stmt->bindParam(":id_theme", $course->getTheme()->getId() ,PDO::PARAM_INT);
		$idEnterprise = 1;
		$stmt->bindParam(":id_enterprise", $idEnterprise ,PDO::PARAM_INT);

		$newId = -1;

		if($stmt->execute()){
			$newId = $this->db->lastInsertId();
		}else{
			throw new DAOException("Error inserting a course on table courses", 1);
		}

		return $newId;
	}

	public function delete($course){
		$deleted = false;
		$sql = "DELETE FROM courses WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $course->getId(), PDO::PARAM_INT);
		//Helper::printVar($course->getId());
		//exit;
		if($stmt->execute()){
			$deleted = true;
		}else{
			throw new DAOException("Error deleting a course with the id equals to " . $course->getId(), 2);
		}
		return $deleted;
	}

	public function update($course){
		$updated = false;
		$sql = "UPDATE courses SET name = :name,
									hours = :hours,
									start_date = :start_date,
									id_theme = :id_theme
									WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":name", $course->getName() ,PDO::PARAM_STR);
		$stmt->bindParam(":hours", $course->getHours() ,PDO::PARAM_INT);
		$stmt->bindParam(":start_date", $course->getStartDate() ,PDO::PARAM_STR);
		$stmt->bindParam(":id_theme", $course->getTheme()->getId() ,PDO::PARAM_INT);
		$stmt->bindParam(":id", $course->getId() ,PDO::PARAM_INT);
		if($stmt->execute()){
			$updated = true;
		}else{
			throw new DAOException("Error updating a course with the id equals to " . $course->getId(), 3);
		}
		return $updated;
	}

	public function getAll(){
		$query = "SELECT * FROM courses";
		$courses = array();
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			if($rows){
				foreach ($rows as $row) {
					$course = new Course();
					$course->setId($row["id"]);	
					$course->setName($row["name"]);
					$course->setHours($row["hours"]);
					$course->setStartDate($row["start_date"]);
					$daoTheme = new ThemeDAO();
					$theme = $daoTheme->get($row["id_theme"]);
					$course->setTheme($theme);
					array_push($courses, $course);
				}
			}else{
				throw new DAOException("There is no courses on the database.", 0);
			}
			
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $courses;
	}
}


?>