<?php 

require_once "models/business/DAO.interface.php";

class CategoryDAO implements DAO{
	
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
		$query = "SELECT * FROM categories WHERE id = :id";
		$category = null;
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(':id' => $id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row){
				$category = new Category();
				$category->setId($row["id"]);	
				$category->setName($row["name"]);
				$category->setCostHour($row["cost_hour"]);
			}else{
				throw new DAOException("There is no category with the id equals to " . $id, 0);
			}
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $category;
	}

	public function insert($category){

	}

	public function delete($category){

	}

	public function update($category){

	}

	public function getAll(){
		$query = "SELECT * FROM categories";
		$categories = array();
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			if($rows){
				foreach ($rows as $row) {
					$category = new Category();
					$category->setId($row["id"]);	
					$category->setName($row["name"]);
					$category->setCostHour($row["cost_hour"]);
					array_push($categories, $category);
				}
			}else{
				throw new DAOException("There is no categories on the database.", 0);
			}
			
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $categories;
	}

}

?>