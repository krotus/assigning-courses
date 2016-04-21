<?php 
//per què no falli la generació del document pdf quan hi ha variables de sessió. Problema que apareix amb el Internet Explorer.
session_cache_limiter('private');
// Iniciem o recuperem la sessió
session_start() ;
require_once("../autoload.php");

// VENIM DE TRIAR EL PETICIONARI
if(isset($_GET["id"]) && $_GET["id"] > 0){
	$id = $_GET["id"];
	//Consultem les dades del peticionari
	$employee = new Employee();
	$employee = $employee->getSelf($id);
	if($employee != null){
	    try {
	    	//TODO: solucionar els caracteres especials provinents de la bbdd
	        $employee->createPDF();
	    } catch (Exception $e) {
	        echo "Ha sorgit algun error <br>" . $e->getMessage();
	    }
	}else{
	    echo "<p>No s'ha trobat cap peticionari amb el codi " . $cod . " </p>";
	    echo "<a href='../views/fitxa_peticionari_id.php'>Enrrera</a>";
	}
}else{
	echo "<p>No has introduit cap codi correcte a la cerca<p>";
	echo "<a href='../views/fitxa_peticionari_id.php'>Enrrera</a>";
}

?>