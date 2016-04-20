<?php 


    include_once("../../app/config/config.inc.php"); //Constants
function __autoload($class_name){
    
    $root = $_SERVER['DOCUMENT_ROOT'];
    $curdir = getcwd();
    
    //chdir("$root/daw/m7/uf3/assigning_courses/");
    chdir(ROOT);
    if( strpos($class_name, "DAO") ){
        $class_name = substr($class_name, 0, strlen($class_name) - 3);
    }

    $daoFile = $class_name.".dao.php";
    $classFile = $class_name.".class.php";
    $utilityFile  = $class_name . ".php";

    $pathDAO = "models/dao/".$daoFile;
    $pathBusiness = "models/business/".$classFile;
    $pathUtility = "app/core/utilities/".$utilityFile;

    //dao's class
    if(file_exists($pathDAO)){
        require_once $pathDAO;
    }
    //business's class
    if(file_exists($pathBusiness)){
       require_once $pathBusiness;
    }
    //utility's class
    if(file_exists($pathUtility)){
       require_once $pathUtility;
    }

    chdir($curdir);
}
?>