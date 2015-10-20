<?php


if(isset($_GET['id'])) {
	
	$idEvent = $_GET['id'];
	
	$res = $db->query('SELECT id,title,date,description,createby FROM tblevenements WHERE id='.$idEvent);
	
	$resultat = $res->fetch();
	
	echo '<div class="padding_block">';
	
	if(!$resultat) {
		echo '<h1>Pas d\'événement</h1>';
		
	} else {
		
		$res = $db->query('SELECT id,title,date,description,createby FROM tblevenements WHERE id='.$idEvent);

		$res->setFetchMode(PDO::FETCH_OBJ);	
		
		while ($event = $res->fetch()) {
			
		echo '<h2>'.$event->title.'</h2>';
		echo '<p>'.$event->date.'<p>';
		echo '<p>'.$event->description.'<p>';	
		echo '<p> Par '.$event->createby.'<p>';			
		}
		
		echo '<h2>Participant</h2>';

		$res = $db->query('SELECT id,idevent,iduser FROM tblparticipants WHERE idevent='.$idEvent);
			
		if($res != "") {
		$res->setFetchMode(PDO::FETCH_OBJ);	
		
		echo '<ul class="liste_participants">';
		

			
		while ($idparticipants = $res->fetch()) {
				
			
				$id = $idparticipants->iduser;
				
				$resultat = $db->query('SELECT id,pseudo FROM tblmembres WHERE id='.$id);
			
				$resultat->setFetchMode(PDO::FETCH_OBJ);	
				$participants = $resultat->fetch();
				
				
				echo '<li><a href="?page=profile&id='.$participants->id.'">'.$participants->pseudo.'</a></li>';
				
				
		}
				
		
		echo '</ul>';
		
		}
		
		echo '<button class="btn" onClick="AddParticipant('.$idEvent.','.$_SESSION['id'].')">Participer</button>';
		
		
		echo '</div>';
	}
	
} else {
	
	echo '<h1>Pas d\'événement</h1>';
	
}




?>