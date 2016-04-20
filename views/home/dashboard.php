<?php include_once("../layout/header.php") ?>
<script>
	
$(document).ready(function(){
	var missatge = "";
	var author = "";
	$("#btn-comentari").on("click", function(){
		missatge = $("#txt-comentari").val();
		author = "<?= $user->getUsername() ?>";
		var comentari = {
			"missatge" : missatge,
			"author" : author
		};

		$.ajax({
			data: comentari,
			type: "POST",
			dataType: "json",
			url: "../../controllers/comment/ctrlAddComment.php",
			success: function(result){
				if(result != "error"){
					afegirComentari(result);
				}else{
					alert("error");
				}
				
	    	}
		});
	});

	var updateComments = function(){
	    $.ajax({
			type: "GET",
			url: "../../controllers/comment/ctrlUpdateComments.php",
			dataType: "json",
			success: function(result){
				for(var i = 0; i < result.length; i++){
					afegirComentari(result[i]);
				}
	    	}
		});
	} 

	setInterval(updateComments, 1000);

});


function afegirComentari(comentari){
	$("#caixa-comentaris").prepend( '<div class="comentari"> ' +
		'<span id="comentari-missatge">'+comentari.comment+'</span>' +
		'<span id="comentari-author">'+comentari.user+'</span>' +
		'<span id="comentari-data">'+comentari.published+'</span>' +
		'</div>' );
	$("#txt-comentari").val(" ");
}

</script>
<h1>Welcome to the Dashboard</h1>
<div class="row">
	<div class="col-md-3" id="wrap-comentaris">
		<h3>Comentaris</h3>
		<div id="caixa-comentaris">
		</div>
		<div id="enviar">
			<div class="form-group">
			  <textarea style="resize:none" class="form-control" rows="2" id="txt-comentari" placeholder="Opina sobre la web"></textarea>
			</div>
			<button id="btn-comentari" class="btn btn-primary">
				<i class="glyphicon glyphicon-send"></i>
			</button>
		</div>	
	</div>
	
</div>
<?php include_once("../layout/footer.php") ?>