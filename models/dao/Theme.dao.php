<?php 

require_once "models/business/DAO.interface.php";

class ThemeDAO implements DAO{


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
		$query = "SELECT * FROM themes WHERE id = :id";
		$theme = null;
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(':id' => $id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row){
				$theme = new Theme();
				$theme->setId($row["id"]);
				$theme->setName($row["name"]);
				$daoCategory = new CategoryDAO();
				$category = $daoCategory->get($row["id_category"]);
				$theme->setCategory($category);
			}else{
				throw new DAOException("There is no theme with the id equals to " . $id, 0);
			}
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $theme;
	}

	public function insert($theme){

	}

	public function delete($theme){

	}

	public function update($theme){

	}

	public function getAll(){
		$query = "SELECT * FROM themes";
		$themes = array();
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			if($rows){
				foreach ($rows as $row) {
					$theme = new Theme();
					$theme->setId($row["id"]);
					$theme->setName($row["name"]);
					$daoCategory = new CategoryDAO();
					$category = $daoCategory->get($row["id_category"]);
					$theme->setCategory($category);
					array_push($themes, $theme);
				}
			}else{
				throw new DAOException("There is no themes on the database.", 0);
			}
			
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $themes;
	}
}


?>