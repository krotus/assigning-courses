<?php 

require_once "models/business/DAO.interface.php";
require_once "app/core/exceptions/DAOException.php";

class EmployeeDAO implements DAO{

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
		$query = "SELECT * FROM employees WHERE id = :id";
		$employee = null;
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(':id' => $id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row){
				$employee = new Employee();
				$employee->setId($row["id"]);	
				$employee->setName($row["name"]);
				$employee->setSurname($row["surname"]);
				$daoCategory = new CategoryDAO();
				$category = $daoCategory->get($row["id_category"]);
				$employee->setCategory($category);
				$employee->setDni($row["dni"]);
				$employee->setEmail($row["email"]);
			}else{
				throw new DAOException("There is no employee with the id equals to " . $id, 0);
			}
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $employee;
	}

	public function insert($employee){
		$sql = "INSERT INTO employees (name,surname,id_category,dni,email) VALUES 
									(:name,:surname,:id_category,:dni,:email)";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":name", $employee->getName() ,PDO::PARAM_STR);
		$stmt->bindParam(":surname", $employee->getSurname() ,PDO::PARAM_STR);
		$stmt->bindParam(":id_category", $employee->getCategory()->getId() ,PDO::PARAM_INT);
		$stmt->bindParam(":dni", $employee->getDni() ,PDO::PARAM_STR);
		$stmt->bindParam(":email", $employee->getEmail() ,PDO::PARAM_STR);

		$newId = -1;
		
		if($stmt->execute()){
			$newId = $this->db->lastInsertId();
		}else{
			throw new DAOException("Error inserting a employee on table employee", 1);
		}

		return $newId;
	}

	public function delete($employee){
		$deleted = false;
		$sql = "DELETE FROM employees WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":id", $employee->getId(), PDO::PARAM_INT);
		if($stmt->execute()){
			$deleted = true;
		}else{
			throw new DAOException("Error deleting a employee with the id equals to " . $employee->getId(), 2);
		}
		return $deleted;
	}

	public function update($employee){
		$updated = false;
		$sql = "UPDATE employees SET name = :name,
									surname = :surname,
									id_category = :id_category,
									dni = :dni,
									email = :email
									WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":name", $employee->getName() ,PDO::PARAM_STR);
		$stmt->bindParam(":surname", $employee->getSurname() ,PDO::PARAM_STR);
		$stmt->bindParam(":id_category", $employee->getCategory()->getId() ,PDO::PARAM_INT);
		$stmt->bindParam(":dni", $employee->getDni() ,PDO::PARAM_STR);
		$stmt->bindParam(":email", $employee->getEmail(),PDO::PARAM_STR);
		$stmt->bindParam(":id", $employee->getId() ,PDO::PARAM_INT);
		if($stmt->execute()){
			$updated = true;
		}else{
			throw new DAOException("Error updating a employee with the id equals to " . $employee->getId(), 3);
		}
		return $updated;
	}

	public function getOwnCourses($employee){
		$query = "SELECT * FROM course_employee WHERE id_employee = :id";
		$stmt = $this->db->prepare($query);
		$stmt->execute(array(':id' => $employee->getId()));
		$rows = $stmt->fetchAll();
		Helper::printVar($rows);
		exit;
		return $courses;
	}

	public function getAll(){
		
	}

}

?>