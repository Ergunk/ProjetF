<?php
	session_start();
	require('config.php');
	
	global $db;

	
	if(isset($_POST["action"])) {
		
		if($_POST['action'] == "logout" ) {
			session_destroy();
			header("location:index.php");
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
				echo 'Mauvais identifiant ou mot de passe !';
			}
			else
			{
				

				
				$_SESSION['id'] = $resultat['id'];
				$_SESSION['user'] = $pseudo;
			
			}
			
		}
		
		
		if($_POST['action'] == 'inscription' ) {
			
			
			
			$pseudo = $_POST['user'];
			$pass_hache = sha1('gz'.$_POST['pass']);
			$email = $_POST['email'];
			

				
			
			$res = $db->query("SELECT pseudo FROM tblmembres WHERE pseudo='".$pseudo."'");
			
			$res->setFetchMode(PDO::FETCH_OBJ);
			
			
			
			if($test = $res->fetch() ){
			   // Pseudo déjà utilisé
			   echo 'Ce pseudo est déjà utilisé';
			  
			}else{
			   // Pseudo libre
			  	$req = $db->prepare('INSERT INTO tblmembres(pseudo, pass, email, date_inscription) VALUES(:pseudo, :pass, :email, CURDATE())');
				$req->execute(array(
					'pseudo' => $pseudo,
					'pass' => $pass_hache,
					'email' => $email));

			}
			
		}
		
	}
	
	
	
	$tblPage = array(
	
		'accueil' => 'accueil.php',
		'evenements' => 'evenements.php',
		'description' => 'description.php',
		'mini-jeux' => 'mini-jeux.php'
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
		<script type="text/javascript" src="js/function.js"></script>
		
		

</head>

<body>

	<div id="wrapper_header">
		<div id="header" class="inner">
			<div id="login">
			
			
			<?php 
				
				if(!isset($_SESSION['user'])) {
			
			?>
				<div >
					<ul>
						<li onClick="Login();" >Login</li>
						<li onClick="Inscription();" >Inscription</li>
						<form method="POST" action="" id="login_form" style="display : none">
						

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

</form>
					
					
					</ul>

				</div>
				
				
			<?php 
				} else {
			?>
				<div id="info_user" >
				
					<p  style="vertical-align: top;display:inline-block" > <?php echo 'Bonjour ' . $_SESSION['user']; ?> </p>
					
					<form id="logout" method="POST" action=""  style="display:inline-block">
					
						<input type="hidden" name="action" value="logout" />
					
						<input  type="submit" class="login-field" value="logout" />
						
					
					</form>
					
				</div>
				
			<?php
			
				}
			?>
				
			</div>
		
			<div id="toggle"><span></span></div>
			
			<div id="menu" >
			<ul  >
				<li><a href="?page=accueil">Accueil</a></li>
				<li><a href="?page=evenements">Evenements</a></li>
				<li><a href="?page=mini-jeux">Mini-jeux</a></li>
			</ul>
			
			</div> 
			
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