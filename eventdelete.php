<?php

require_once("config.php");
if (isset($_POST['id'])) {
	
	$id=$_POST['id'];
	$req = $db->prepare('DELETE FROM tblevenements WHERE id=:id');
	$req->execute(array('id' => $id));
}
else {
	echo 'Pas d\'ID';
}
?>
