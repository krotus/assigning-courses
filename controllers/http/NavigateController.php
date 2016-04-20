<?php 

//Recollim nom del fitxer executat sense el seu camí ( funció  basename() )
$fitxer = basename($_SERVER['PHP_SELF']);
$pieces = explode( "/", $_SERVER['PHP_SELF']);  // 2012 substitució de la funció obsoleta split per explode
$accio = $fitxer;
$parent = array_pop($pieces); //2 pops
$parent = array_pop($pieces); //parent
?>

<script>
function avisar(){

	var fitx = '<?php echo $accio; ?>';

	if(fitx=='new.php'||fitx=='edit.php'||fitx=='delete.php'){
		return confirm ("Sortir sense desar les modificacions?");
	}
}
</script>

<?php
if($fitxer != "index.php"){ 
	echo '<a href="../'. $parent .'/list.php"  class="btn btn-primary sweeter" name="btn_cancel">Cancel</a>';
}

