<?php 

require_once("../autoload.php");

$comment = new Comment();
$comments = $comment->getAll();
foreach ($comments as &$comment) {
	$username = $comment->getUser()->getUsername();
	$comment->setUser($username);
}
echo json_encode($comments);

?>