



<?php

				require('config.php');
				
				
                $req = $db->query('SELECT * FROM tblmessages ORDER BY id DESC LIMIT 0,10');
				
				/*$req->setFetchMode(PDO::FETCH_OBJ);*/

				$result = $req->fetchAll();
				
				$result = array_reverse($result);
				
				foreach ($result as $value) {
					
					$idUser = $value["iduser"];
					$res = $db->query('SELECT id,pseudo,email,image,date_inscription FROM tblmembres WHERE id='.$idUser);
					$res->setFetchMode(PDO::FETCH_OBJ);
					echo '<div >';
					
					while ($user = $res->fetch()) {
						
						echo '<div class="user-profile">';
						
						if($user->image == null) {
								
							echo '<img src="images/bangkok.jpg" alt="Bangkok" title="Bangkok" />';
								
							} else {
								
								echo '<img src="images/profiles/'.$user->image.'" alt="'.$user->image.'" title="'.$user->image.'" />';
						}
						
						echo '</div>';
					}
					
					echo "<p id=\"" . $value['id'] . "\"><b>" . ucfirst($value['auteur']) . "</b><br>" . $value['message'] . "</p>";

					echo '</div>';
				}
				


                $req->closeCursor();
?>