<?php include_once("../layout/header.php");?>

<?php if(isset($_GET['id'])){ ?>
<div class="row text-center">
	<form action="../../controllers/course/ctrlDeleteCourse.php" method="post">
	<input type="hidden" id="id_course" name="id_course" value="<?= $_GET['id'] ?>">
		<p>Are you sure to delete the course id: <?= $_GET['id'] ?></p>
		<div class="form-group row">
		    <div class="text-center">
		      	<button type="submit" class="btn btn-info" name="btn_cancel_delete">Cancel</button>
		      	<button type="submit" class="btn btn-danger" name="btn_action_delete">Accept</button>
		    </div>
		</div>
	</form>
</div>
<?php } ?>


<?php include_once("../layout/footer.php");?>