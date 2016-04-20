<?php 

require_once "models/business/DAO.interface.php";

class CommentDAO implements DAO{
	
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
		$query = "SELECT * FROM comments WHERE id = :id";
		$comment = null;
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute(array(':id' => $id));
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			if ($row){
				$comment = new Comment();
				$comment->setId($row["id"]);
				$comment->setComment($row["comment"]);
				$idUser = $row["id_user"];
				$user = new User();
				$user = $user->getSelf($id_user);
				$comment->setUser($user);
				$comment->setPublished($row["published"]);
			}else{
				throw new DAOException("There is no comentari with the id equals to " . $id, 0);
			}
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $comment;
	}

	public function insert($comment){
		$sql = "INSERT INTO comments (comment,id_user,published) VALUES 
									(:comment,:id_user,:published)";
		$stmt = $this->db->prepare($sql);
		$stmt->bindParam(":comment", $comment->getComment() ,PDO::PARAM_STR);
		$stmt->bindParam(":id_user", $comment->getUser()->getId() ,PDO::PARAM_INT);
		$stmt->bindParam(":published", $comment->getPublished() ,PDO::PARAM_STR);

		$newId = -1;

		if($stmt->execute()){
			$newId = $this->db->lastInsertId();
		}else{
			throw new DAOException("Error inserting a comment on table comments", 1);
		}

		return $newId;
	}

	public function delete($comment){

	}

	public function update($comment){

	}

	public function getAll(){
		$query = "SELECT * FROM comments";
		$comments = array();
		try {
			$stmt = $this->db->prepare($query);
			$stmt->execute();
			$rows = $stmt->fetchAll();
			if($rows){
				foreach ($rows as $row) {
					$comment = new Comment();
					$comment->setId($row["id"]);
					$comment->setComment($row["comment"]);
					$idUser = $row["id_user"];
					$user = new User();
					$user = $user->getSelf($idUser);
					$comment->setUser($user);
					$comment->setPublished($row["published"]);
					array_push($comments, $comment);
				}
			}else{
				throw new DAOException("There is no comenta on the database.", 0);
			}
			
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $comments;
	}

	
}


?>