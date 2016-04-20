<?php 

require_once "models/business/DAO.interface.php";

class UserDAO implements DAO{
	
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
		$query = "SELECT * FROM users WHERE id = :id";
		$user = null;
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(':id' => $id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row){
				$user = new User();
				$user->setId($row["id"]);
				$user->setUsername($row["username"]);
				$user->setPassword($row["password"]);
			}else{
				throw new DAOException("There is no user with the id equals to " . $id, 0);
			}
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $user;
	}

	public function insert($user){

	}

	public function delete($user){

	}

	public function update($user){

	}

	public function getAll(){
		$query = "SELECT * FROM users";
		$users = array();
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			if($rows){
				foreach ($rows as $row) {
					$user = new User();
					$user->setId($row["id"]);
					$user->setUsername($row["username"]);
					$user->setPassword($row["password"]);
					array_push($users, $user);
				}
			}else{
				throw new DAOException("There is no users on the database.", 0);
			}
			
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $users;
	}

	public function getByUsername($username){
		$query = "SELECT * FROM users WHERE username = :username";
		$user = null;
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(':username' => $username));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row){
				$user = new User();
				$user->setId($row["id"]);
				$user->setUsername($row["username"]);
				$user->setPassword($row["password"]);
			}else{
				throw new DAOException("There is no user with the id equals to " . $id, 0);
			}
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $user;
	}

	
}


?>