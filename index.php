<?php
	session_start();
	require('config.php');
	global $db;
	
	
	$tblPage = array(
		'accueil' => 'accueil.php',
		'evenements' => 'evenements.php',
		'description' => 'description.php',
		'profile' => 'profile.php',
		'login' => 'login.php',
	);
	
	
	if(isset($_SESSION['id']) && isset($_SESSION['user'])) {
		if(isset($_GET['page'])) {
		
		$pageName = $_GET['page'];

		} else {
			
		$pageName = 'accueil';
		
		}
		
		if(!array_key_exists($pageName ,$tblPage)) {
		
		$pageName = 'accueil';
		
		} 
		
		$page = $tblPage[$pageName];
		
	} else {
		
		header("location:login.php");
	}

	if(isset($_POST["action"])) {
		
		if($_POST['action'] == "logout" ) {
			$req = $db->query("UPDATE tblmembres SET status='offline' WHERE id='".$_SESSION['id']."'");
			session_destroy();
			header("location:login.php");
		}
		
		if($_POST['action'] == "addevent" ) {
			
			$titre = $_POST['title'];
			$date = $_POST['date'];
			$desc = $_POST['desc'];
			
			
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
		<link rel="stylesheet" type="text/css" href="css/slider.css">
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
   

		
		<!--<div>
			<a href="" ><span class="fa fa-users"></span></a>
		</div>-->
		
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