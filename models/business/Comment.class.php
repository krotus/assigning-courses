<?php 

class Comment extends DataObject{

	public $id = null;
	public $comment = null;
	public $user = null;
	public $published = null;

	public function __construct(){
		parent::__construct($this);
	}

	public function getId(){
		return $this->id;
	}

	public function getComment(){
		return $this->comment;
	}

	public function getUser(){
		return $this->user;
	}

	public function getPublished(){
		return $this->published;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function setComment($comment){
		$this->comment = $comment;
	}

	public function setUser($user){
		$this->user = $user;
	}

	public function setPublished($published){
		$this->published = $published;
	}

}

?>