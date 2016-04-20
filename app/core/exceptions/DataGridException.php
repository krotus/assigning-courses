<?php 

class DataGridException extends Exception{

    private $error = "";

    public function __construct($message, $code = 0) {
        parent::__construct($message, $code);
        $this->setError($code);
    }

    public function getError(){
        return $this->error;
    }

    public function setError($code){
        $errors = include("../app/core/exceptions/Codes.php");
        $this->error = $errors[$code];
    }

    public function getErrorMessage(){
        return $this->getError() . "\n cause: \n" . $this->getMessage();
    }
}


?>