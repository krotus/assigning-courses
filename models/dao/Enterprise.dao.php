<?php 

require_once "models/business/DAO.interface.php";

class EnterpriseDAO implements DAO{

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
		$query = "SELECT * FROM enterprise WHERE id = :id";
		$enterprise = null;
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(':id' => $id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row){
				$enterprise = new Enterprise();
				$enterprise->setId($row["id"]);
				$enterprise->setName($row["name"]);
				$enterprise->setRegion($row["region"]);
				$enterprise->setCity($row["city"]);
			}else{
				throw new DAOException("There is no enterprise with the id equals to " . $id, 0);
			}
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $enterprise;
	}

	public function insert($enterprise){

	}

	public function delete($enterprise){

	}

	public function update($enterprise){

	}

	public function getAll(){
		
	}
}


?>