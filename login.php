<?php
	session_start();
	require('config.php');
	global $db;
	
	
	if(isset($_POST["action"])) {
		
		if($_POST['action'] == 'login' ) {
			
			$pseudo = $_POST['user'];
			$pass_hache = sha1('gz'.$_POST['pass']);

			$req = $db->prepare('SELECT id FROM tblmembres WHERE pseudo=:pseudo AND pass=:pass');

			$req->execute(array(
				'pseudo' => $pseudo,
				'pass' => $pass_hache));

				
			$resultat = $req->fetch();

			if (!$resultat)
			{
				$erreur = 'Mauvais identifiant ou mot de passe !';
			}
			else
			{
				$_SESSION['id'] = $resultat['id'];
				$_SESSION['user'] = $pseudo;
				header("location:index.php?page=accueil");
			}
			
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
		
		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		<script type="text/javascript" src="js/function.js"></script>
		<script type="text/javascript" src="js/modalWindow.js"></script> <!-- Chargement du script local -->
		
		

</head>

<body id="login">

<form method="POST" action="" id="login_form" >
						

	<div class="control-groupe">
		<input type="text" class="login-field" name="user" placeholder="username" />
	</div>
	
	<div class="control-groupe">
		<input type="password" class="login-field" name="pass" placeholder="password" />
	</div>
	
	<input type="hidden" name="action" value="login"/>


	<div class="control-groupe">
	
		<input type="submit" class="login-field" value="Connexion" />
	</div>

	<?php
	if(isset($erreur)) {
		
		echo '<p class="erreur"style="text-align:center">'.$erreur.'</p>';
	}
?>
</form>

</body>

</html>


