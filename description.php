<?php


if(isset($_GET['id'])) {
	
	$id = $_GET['id'];
	
	$res = $db->query('SELECT id,title,date,description,createby FROM tblevenements WHERE id='.$id);
		
	$res->setFetchMode(PDO::FETCH_OBJ);	
		
	while ($event = $res->fetch()) {
			
		echo '<h2>'.$event->title.'</h2>';
		echo '<p>'.$event->date.'<p>';
		echo '<p>'.$event->description.'<p>';	
		echo '<p> Par '.$event->createby.'<p>';			
	}
	
	echo '<h2>Participant</h2>';

	$res = $db->query('SELECT id,idevent,pseudo FROM tblparticipants WHERE idevent='.$id);
		
	$res->setFetchMode(PDO::FETCH_OBJ);	
	
	
	while ($participants = $res->fetch()) {
		
		echo '<p>'.$participants->pseudo.'<p>';
		
	}
	
	
}




?>