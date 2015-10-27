<?php
	session_start();
	require('config.php');
	global $db;
	
	
	if(isset($_POST["action"])) {
		
		if($_POST['action'] == 'login' ) {
			
			if($_POST['user'] != "" && $_POST['pass'] != "") {
				
				
				$pseudo = $_POST['user'];
				$pass_hache = sha1('gz'.$_POST['pass']);
				
				/* Regarde si une occurence éxiste */
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
					
					/* Crée la session */
					$_SESSION['id'] = $resultat['id'];
					$_SESSION['user'] = $pseudo;
					
					/* Change le status de l'utilisateur */
					$req = $db->query("UPDATE tblmembres SET status='online' WHERE id='".$_SESSION['id']."'");
					header("location:index.php?page=accueil");
				}
			} else {
				
				$erreur = "Veuillez remplir les champs";
			}
		}

		if($_POST['action'] == 'inscription' ) {
			
			if($_POST['user'] != "" && $_POST['pass'] != "" && $_POST['email'] != "") {
			
				$pseudo = $_POST['user'];
				$pass_hache = sha1('gz'.$_POST['pass']);
				$email = $_POST['email'];
				

				/* Regarde si une occurence existe */
				$res = $db->query("SELECT pseudo FROM tblmembres WHERE pseudo='".$pseudo."'");
				$res->setFetchMode(PDO::FETCH_OBJ);

				
				if($test = $res->fetch() ){
				   // Pseudo déjà utilisé
				   $erreur = 'Ce pseudo est déjà utilisé';
				  
				}else{
				   // Pseudo libre
				   
				   /* Ajoute l'utilisateur à la base de données */
					$req = $db->prepare('INSERT INTO tblmembres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
					$req->execute(array(
						'pseudo' => $pseudo,
						'pass' => $pass_hache,
						'email' => $email));
					$message = "Inscription réussite";
				}
			} else {
				
				$erreur = "Veuillez remplir les champs";
				
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
		
		if(isset($message)) {
			echo '<p style="text-align:center;color:green;">'.$message.'</p>';
		}
	?>
	
	<a href="#" onClick="Inscription();">Inscription</a> 
</form>

<form method="POST" action="" id="inscription_form" style="display : none">

	<div class="control-groupe">
		<input type="text" class="login-field" name="user" placeholder="username" />
	</div>
	
	<div class="control-groupe">
		<input type="password" class="login-field" name="pass" placeholder="password" />
	</div>
	
	
	<div class="control-groupe">
		<input type="email" class="login-field" name="email" placeholder="email" />
	</div>
	

		<input type="hidden" name="action" value="inscription"/>


	<div class="control-groupe">
	
		<input type="submit" class="login-field" value="Inscription" />
	</div>

	<a href="#" onClick="Login();">Login</a> 
	
</form>



</body>

</html>


