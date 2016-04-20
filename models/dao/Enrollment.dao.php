<?php 

require_once "models/business/DAO.interface.php";

class EnrollmentDAO implements DAO{

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
		$query = "SELECT * FROM course_employee WHERE id = :id";
		$course = null;
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(':id' => $id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row){
				$enrollment = new Enrollment();
				$enrollment->setId($row["id"]);

				$daoCourse = new CourseDAO();
				$course = $daoCourse->get($row["id_course"]);
				$enrollment->setCourse($course);

				$daoEmployee = new EmployeeDAO();
				$employee = $daoEmployee->get($row["id_employee"]);
				$enrollment->setEmployee($employee);

				$enrollment->setImprovement($row["improvement"]);
				$enrollment->setDate($row["date"]);
			}else{
				throw new DAOException("There is no enrollment with the id equals to " . $id, 0);
			}
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $course;
	}

	public function insert($enrollment){
		$sql = "INSERT INTO course_employee (id_course,id_employee,improvement,join_date) VALUES 
									(:id_course,:id_employee,:improvement,:join_date)";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id_course", $enrollment->getCourse()->getId() ,PDO::PARAM_INT);
		$stmt->bindParam(":id_employee", $enrollment->getEmployee()->getId() ,PDO::PARAM_INT);
		$improvement = 0;
		$stmt->bindParam(":improvement", $improvement ,PDO::PARAM_STR);
		$stmt->bindParam(":join_date", date("Y-m-d"),PDO::PARAM_STR);
		$newId = -1;

		if($stmt->execute()){
			$newId = $this->db->lastInsertId();
		}else{
			throw new DAOException("Error inserting a enrollment on an employee on table course_employee", 1);
		}

		return $newId;
	}

	public function delete($enrollment){

	}

	public function update($enrollment){

	}

	public function getAll(){
		
	}
}


?>