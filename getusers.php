<?php
		
				require('config.php');
				
                $req = $db->query('SELECT * FROM tblmembres WHERE status="online" ');
				
				$req->setFetchMode(PDO::FETCH_OBJ);
				
				
				echo '<h3>Utilisateurs connectés</h3>';
				
				echo '<ul>';
				
                while($donnees = $req->fetch()){

					echo '<li><a href="?page=profile&id='.$donnees->id.'" >'.$donnees->pseudo.'</a></li>';
                }
				
				echo '</ul>';

                $req->closeCursor();
?>