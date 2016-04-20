<?php 

require_once("../autoload.php");

	if(isset($_POST['missatge']) && isset($_POST['author'])){
		if(!empty($_POST['missatge'])){
			$message = $_POST['missatge'];
			$comment = new Comment();
			$comment->setComment($message);
			
			$author = $_POST['author'];
			$user = new User();
			$user = $user->getSelfByUsername($author);
			$comment->setUser($user);

			$comment->setPublished(date('Y-m-d H:i:s'));
			if($comment->add()){
				//transformo el usuari per el username, visió més clara al cantó del client
				$comment->setUser($user->getUsername());
				echo json_encode($comment);
			}else{
				echo "error";
			};
		}
	}
?>