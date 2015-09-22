<?php

require_once("config.php");
if (isset($_POST['id'])) {
	
	$id=$_POST['id'];
	$pseudo = $_POST['user'];

	
	$req = $db->prepare('DELETE FROM tblevenements WHERE id=:id and createby=:pseudo');
	$req->execute(array('id' => $id , 'pseudo' => $pseudo ));
	
	
	
}
else {
	echo 'Pas d\'ID';
}
?>
