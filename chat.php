<?php
	
	/* Connexion à la base de données */
	require('config.php');
	
	if(isset($_POST)){ 

		if(!empty($_POST['pseudo']) AND !empty($_POST['message'])){ // si les variables ne sont pas vides
		
			$iduser = $_POST['iduser'];
			$pseudo = $_POST['pseudo'];
			$message = $_POST['message']; 
			
			$req = $db->prepare('INSERT INTO tblmessages VALUES("", :iduser , :pseudo, :message)');
			$req->execute(array(
				'iduser' => $iduser,
				'pseudo' => $pseudo,
				'message' => $message
			));

		}
		else{
			echo "Vous avez oublié de remplir un des champs !";
		}

	}

?>
