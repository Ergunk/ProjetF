<div id="chat_area">

<div>

	<div id="message_area" class="text-area">
		
		<?php
		
				require('config.php');
				
                $req = $db->query('SELECT * FROM tblmessages ORDER BY id DESC LIMIT 0,10');

				$req->setFetchMode(PDO::FETCH_OBJ);	
				
                while($donnees = $req->fetch()){

                    // on affiche le message (l'id servira plus tard)

                    echo "<p id=\"" . $donnees->id . "\">" . $donnees->auteur . " dit : " . $donnees->message . "</p>";

                }


                $req->closeCursor();
		?>
	
	</div>

	<div class="input-area">
	
		<div class="input-wrapper">
				<input id="message" name="message" value="" type="text" />
		</div>
		<input id="pseudo" type="hidden" name="pseudo" value="<?php echo $_SESSION['user']; ?>" />
		<input type="submit" name="submit" value="Envoyer" id="submit_chat">
	
	</div>
			
</div> 

<div>


</div>


</div>