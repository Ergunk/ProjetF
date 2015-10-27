<?php

	session_start();
	
	/* Connexion DB */
	require('config.php');
	global $db;
	
	/* Tableau des pages disponibles */
	$tblPage = array(
		'accueil' => 'accueil.php',
		'evenements' => 'evenements.php',
		'description' => 'description.php',
		'profile' => 'profile.php',
		'login' => 'login.php',
	);
	
	
	if(isset($_SESSION['id']) && isset($_SESSION['user'])) {
		/* Une session est déjà crée */
		
		/* Récupère la page si elle est passé en get */
		if(isset($_GET['page'])) {
		
			$pageName = $_GET['page'];

		} else {
			
			/* Par defaut page d'accueil */
			$pageName = 'accueil';
		
		}
		
		/* Regarde si la page existe dans le tableau */
		if(!array_key_exists($pageName ,$tblPage)) {
			
			/* S'il existe pas, on met accueil */
			$pageName = 'accueil';
		
		} 
		
		/* Récupère la page dans le tableau */
		$page = $tblPage[$pageName];
		
	} else {
		
		/* Redirige vers la page login car il n'y a pas de session */
		header("location:login.php");
	}

	if(isset($_POST["action"])) {
		
		if($_POST['action'] == "logout" ) {
			/* Met le joueur offline */
			$req = $db->query("UPDATE tblmembres SET status='offline' WHERE id='".$_SESSION['id']."'");
			
			/* Détruit la session*/
			session_destroy();
			
			/* redirige vers la page login */
			header("location:login.php");
		}
		
		if($_POST['action'] == "addevent" ) {
			
			$titre = $_POST['title'];
			$date = $_POST['date'];
			$desc = $_POST['desc'];
			
			/* Ajoute l'événement dans la base de données */
			$req = $db->prepare('INSERT INTO tblevenements(title,date,description,createby) VALUES(:title , :date , :description, :pseudo)');
			$req->execute(array(
			'title' => $titre,
			'date' => $date,
			'description' => $desc,
			'pseudo' => $_SESSION['user']));

		}
		
	}
				

?>


<!DOCTYPE HTML>
<html>

<head>
        <title>4MPI4I2</title>
        <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/default.css">
		<link rel="stylesheet" type="text/css" href="css/modalWindow.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="css/chat.css">
		
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/function.js"></script>
		<script type="text/javascript" src="js/modalWindow.js"></script> <!-- Chargement du script local -->
		
		

</head>

<body>

	<div id="wrapper_header">

<div id="header">



	<?php
		
		/* Permet de changer le style quand on est sur la page définis */
		if(isset($_GET["page"])) {
			
			if($_GET["page"] == "accueil") {
				
				echo '<div id="accueil" class="active">';
				
			} else {
				
				echo '<div id="accueil" >';
			}
		
		} else {
			echo '<div id="accueil"  class="active">';
		}
		
		echo '<a href="?page=accueil"><span class="fa fa-home"></span></a>';
		echo '</div>';
	?>

	
	<?php
		
		if(isset($_GET["page"])) {
			
			if($_GET["page"] == "evenements") {
				
				echo '<div id="evenements" class="active">';
				
			} else {
				
				echo '<div id="evenements" >';
			}
		
		} else {
			
			echo '<div id="evenements" >';
		}
		
		echo '<a href="?page=evenements"><span class="fa fa-calendar"></span></a>';
		echo '</div>';
	?>

			




</div>

</div>
   
   
   <div id="wrapper_contenu">
   
		<div id="contenu" class="inner">
	
			<?php
			

				/* Récupère le contenu de la page */
				include($page);
			
			
			?>
		
		</div>
   
   </div>
   
  
		<?php
		if(isset($_GET["page"])) {
			
			if($_GET["page"] == "profile") {
				
				echo  '<div id="wrapper_footer" style=" border-top-width : 0px;">';
				
				echo '<div class="icone active">';
				
			} else {
				echo  '<div id="wrapper_footer">';
				echo '<div >';
			}
		
		} else {
			
			echo  '<div id="wrapper_footer">';
				echo '<div >';
		}
		
		echo '<a href="?page=profile&id='.$_SESSION['id'].'"><span class="fa fa-user"></span></a>';
		echo '</div>';
		
		?>
   

	
		
		<div>
			<form id="logout" method="POST" action=""  style="display:inline-block" >
					
						<input type="hidden" name="action" value="logout" />

						 <button type="submit" class="login-field">
							<span class="fa fa-sign-out"></span>
						</button>
					
			</form>
		
		
		</div>
   </div>

</body>
</html>