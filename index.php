<?php

	$tblPage = array(
	
		'accueil' => 'accueil.php',
		'evenements' => 'evenements.php',
		'mini-jeux' => 'mini-jeux.php',
	);
			
	if(isset($_GET['page'])) {
		
		$pageName = $_GET['page'];

	} else {
			
		$pageName = 'accueil';
		
	}
		
	if(!array_key_exists($pageName ,$tblPage)) {
		
		$pageName = 'accueil';
		
	} 
		
	$page = $tblPage[$pageName];
	
		

		
?>

<!DOCTYPE HTML>
<html>

<head>
        <title>4MPI4I2</title>
        <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/default.css">
		<link rel="stylesheet" type="text/css" href="css/slider.css">
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		

</head>

<body>

	<div id="wrapper_header">
		<div id="header" class="inner">
			<ul class="nav" >
				<li><a href="?page=accueil">Accueil</a></li>
				<li><a href="?page=evenements">Evenements</a></li>
				<li><a href="?page=mini-jeux">Mini-jeux</a></li>
			</ul>
		</div>
	</div>
	

	<?php
	
		include('slider.php');
	?>
   
   
   
   <div id="wrapper_contenu">
   
		<div id="contenu" class="inner">
	
			<?php
			


				include($page);
			
			?>
		
		</div>
   
   </div>
   
   
   <div id="wrapper_footer">
		<div id="footer" class="inner">
				
			<div class="col_50">

			</div>
			
			<div class="col_50">
			
			</div>
			
		</div>
   </div>
   
</body>
</html>