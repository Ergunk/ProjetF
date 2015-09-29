<?php
	
	require('config.php');
	
	if(isset($_POST)){ // si on a envoyé des données avec le formulaire

		if(!empty($_POST['pseudo']) AND !empty($_POST['message'])){ // si les variables ne sont pas vides
		
			$pseudo = mysql_real_escape_string($_POST['pseudo']);
			$message = mysql_real_escape_string($_POST['message']); // on sécurise nos données
			
			$req = $db->prepare('INSERT INTO tblmessages VALUES("", :pseudo, :message)');
			$req->execute(array(
				'pseudo' => $pseudo,
				'message' => $message
			));

		}
		else{
			echo "Vous avez oublié de remplir un des champs !";
		}

	}

?>
