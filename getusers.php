<?php
		
	/* Connexion DB */	
	require('config.php');
				
	/* Récupère tous les utilisateurs dont les satus sont online */			
    $req = $db->query('SELECT * FROM tblmembres WHERE status="online" ');	
	$req->setFetchMode(PDO::FETCH_OBJ);
				
	
	/* Affiche les utilisateurs */
	echo '<h3>Utilisateurs connectés</h3>';
				
		echo '<ul>';
				
        while($donnees = $req->fetch()){

			echo '<li><a href="?page=profile&id='.$donnees->id.'" >'.$donnees->pseudo.'</a></li>';
        }
				
		echo '</ul>';

    $req->closeCursor();
	
?>