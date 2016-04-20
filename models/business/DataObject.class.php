<?php 

class DataObject{

	public $typeObject = null;

	public function __construct($object){
		$this->typeObject = get_class($object);
	}

	public function update(){
		$updated = false;
		try {
			$stringToEval = "new ". $this->typeObject . "DAO();";
			eval("\$dao = $stringToEval");
			$res = $dao->update($this);
			if($res){
				$updated = true;
			}
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $updated;
	}

	public function add(){
		$added = false;

		try {
			$stringToEval = "new ". $this->typeObject . "DAO();";
			eval("\$dao = $stringToEval");
			$id = $dao->insert($this);

			if($id > 0){
				$this->setId($id);
				$added = true;
			}
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}

		return $added;
	}

	public function delete(){
		$deleted = false;
		try {
			$stringToEval = "new ". $this->typeObject . "DAO();";
			eval("\$dao = $stringToEval");
			$res = $dao->delete($this);
			if($res){
				$deleted = true;
			}
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}

		return $deleted;
	}

	public function getAll(){
		$objects = array();
		try {
			$stringToEval = "new ". $this->typeObject . "DAO();";
			eval("\$dao = $stringToEval");
			$objects = $dao->getAll();
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $objects;
	}


	public function getSelf($id){
		$object = null;
		try {
			$stringToEval = "new ". $this->typeObject . "DAO();";
			eval("\$dao = $stringToEval");
			$object = $dao->get($id);
		} catch (DAOException $e) {
			echo $e->getErrorMessage();
		}
		return $object;
	}
}

?>