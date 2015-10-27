<?php

/* Repris de http://www.grafikart.fr/tutoriels/php/calendrier-php-157 */

class Date{
	
	/* Tableau des jours*/
	var $days = array('Lundi' , 'Mardi' , 'Mercredi' , 'Jeudi' , 'Vendredi', 'Samedi' , 'Dimanche' );
	
	/* Tableau des mois */
	var $months = array('Janvier', 'Février' , 'Mars' , 'Avril' , 'Mai' , 'Juin' , 'Juillet' , 'Août' , 'Septembre' , 'Octobre' , 'Novembre' , 'Décembre' );
	
	
	/* fonction qui permet de récupérer les événements de l'année */
	function getEvents($year){
		
		/* Permet de récupérer la connexion à la base de données */
		global $db;
		
		$req = $db->query('SELECT id,title,date,description,createby FROM tblevenements WHERE YEAR(date)='.$year);
		$r = array();
		
		while ($d = $req->fetch(PDO::FETCH_OBJ)) {			
			$r[strtotime($d->date)][$d->id] = $d->id.'.-.'.$d->title.'.-.'.$d->description.'.-.'.$d->createby;
		}
		
		return $r;
	}
	
	
	/* fonction qui permet de créer le calendrier selon l'année envoyée */
	function getAll($year) {
		
		$r = array();
		$date = new DateTime($year.'-01-01');
		while($date->format('Y') <= $year ){
			
			$y = $date->format('Y');
			$m = $date->format('n');
			$d = $date->format('j');
			
			$w = str_replace('0','7',$date->format('w'));
			$r[$y][$m][$d] = $w;
		
			$date->add(new DateInterval('P1D'));
		
		}
		
		return $r;
		
	}
	
	
}


?>