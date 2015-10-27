<?php

/* Connexion base de données */
require_once("config.php");


if(isset($_POST['action'])) {
	
	/* Efface l'événement envoyé par POST */
	if($_POST['action'] == "DeleteEvent") {
		if (isset($_POST['id'])) {
	
			$id=$_POST['id'];
			$pseudo = $_POST['user'];

			
			$req = $db->prepare('DELETE FROM tblevenements WHERE id=:id and createby=:pseudo');
			$req->execute(array('id' => $id , 'pseudo' => $pseudo ));
			
		}
		else {
			echo 'Pas d\'ID';
		}
		
	}
	
	
	/* Ajoute l'utilisateur envoyé à un événement */
	
	if($_POST['action'] == "AddParticipant"){
		
		
		
		
		$idEvent=$_POST['id'];
		$idParticipant = $_POST['user'];
		$req = $db->prepare('INSERT INTO tblparticipants(idevent,iduser) VALUES(:id, :idParticipant)');
		$req->execute(array('id' => $idEvent , 'idParticipant' => $idParticipant ));
	
	}

}


?>
