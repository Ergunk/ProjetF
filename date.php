<?php

class Date{
	
	var $days = array('Lundi' , 'Mardi' , 'Mercredi' , 'Jeudi' , 'Vendredi', 'Samedi' , 'Dimanche' );
	var $months = array('Janvier', 'Février' , 'Mars' , 'Avril' , 'Mai' , 'Juin' , 'Juillet' , 'Août' , 'Septembre' , 'Octobre' , 'Novembre' , 'Décembre' );
	
	function getEvents($year){
		global $db;
		
		$req = $db->query('SELECT id,title,date,description FROM tblevenements WHERE YEAR(date)='.$year);
		$r = array();
		
		while ($d = $req->fetch(PDO::FETCH_OBJ)) {
			
			$r[strtotime($d->date)][$d->id] = $d->id.'.-.'.$d->title.'.-.'.$d->description;
			
			
		}
		
		return $r;
	}
	
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
		/*
		$date = strtotime($year.'-01-01');
		while(date('Y',$date) <= $year ){
			
			$y = date('Y',$date);
			$m = date('n',$date);
			$d = date('j',$date);
			$w = str_replace('0','7',date('w',$date));
			$r[$y][$m][$d] = $w;
		
			
			$date = strtotime(date('Y-m-d',$date).' +1 DAY');
			//$date = $date + 24 * 3600;
		
		}
		
		*/

?>