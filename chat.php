<?php
	
	require('config.php');
	
	if(isset($_POST)){ // si on a envoyé des données avec le formulaire

		if(!empty($_POST['pseudo']) AND !empty($_POST['message'])){ // si les variables ne sont pas vides
		
			$iduser = mysql_real_escape_string($_POST['iduser']);
			$pseudo = mysql_real_escape_string($_POST['pseudo']);
			$message = mysql_real_escape_string($_POST['message']); // on sécurise nos données
			
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
