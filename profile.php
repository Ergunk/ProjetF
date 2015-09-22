<script type="text/javascript">
 
	function refresh(user) {
	
		var block = document.getElementById("bonjour");
		
		block.innerHTML = "Bonjour "+user;
					 
	}
</script>	

<?php

require_once("config.php");

if(isset($_GET['id'])) {
	
	$idUser = $_GET['id'];

if(isset($_POST['action'])){

if($_POST['action'] == "UpdateProfile"){
			
		
		if($_POST["pseudo"] != "" && $_POST['email']!= ""){
			
			
			if($_SESSION["user"] != $_POST["pseudo"]) {
				$res = $db->query("SELECT pseudo FROM tblmembres WHERE pseudo='".$_POST['pseudo']."'");
				$res->setFetchMode(PDO::FETCH_OBJ);
				
				if($test = $res->fetch() ){
				// Pseudo déjà utilisé
					$erreur = 'Ce pseudo est déjà utilisé';
					
					$update = false;
					
				} else {
					$update = true;
				}
			} else {
				
				$update = true;
			}
	
			if($update == true){
				
				
				$message = 'Upload réussi !';
				$req = $db->prepare('UPDATE tblmembres SET pseudo=:pseudo, email=:email  WHERE id='.$_SESSION['id']);
				$req->execute(array(
				'pseudo' => $_POST['pseudo'],
				'email' =>  $_POST['email']));
			
				$_SESSION['user'] = $_POST['pseudo'];
			
		
				echo "<script>refresh('".$_SESSION['user']."');</script>";
				
		
			}
		} else {
			
			 $erreur = 'Veuillez remplir les champs';
		}
			
	
}


if($_POST['action'] == "UploadImage"){
		
		
		
		
		// Constantes
		define('TARGET', 'images/profiles/');    // Repertoire cible
		define('MAX_SIZE', 100000);    // Taille max en octets du fichier
		define('WIDTH_MAX', 1800);    // Largeur max de l'image en pixels
		define('HEIGHT_MAX', 1800);    // Hauteur max de l'image en pixels
		 
		// Tableaux de donnees
		$tabExt = array('jpg','gif','png','jpeg');    // Extensions autorisees
		$infosImg = array();
		 
		// Variables
		$extension = '';
		$message = '';
		$nomImage = '';
		
		if(!empty($_POST))
		{
		  // On verifie si le champ est rempli
		  if( !empty($_FILES['image']['name']) )
		  {
			// Recuperation de l'extension du fichier
			$extension  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		 
			// On verifie l'extension du fichier
			if(in_array(strtolower($extension),$tabExt))
			{
			  // On recupere les dimensions du fichier
			  $infosImg = getimagesize($_FILES['image']['tmp_name']);
		 
			  // On verifie le type de l'image
			  if($infosImg[2] >= 1 && $infosImg[2] <= 14)
			  {
				// On verifie les dimensions et taille de l'image
				if(($infosImg[0] <= WIDTH_MAX) && ($infosImg[1] <= HEIGHT_MAX) && (filesize($_FILES['image']['tmp_name']) <= MAX_SIZE))
				{
				  // Parcours du tableau d'erreurs
				  if(isset($_FILES['image']['error']) 
					&& UPLOAD_ERR_OK === $_FILES['image']['error'])
				  {
					// On renomme le fichier
					$nomImage = md5(uniqid()) .'.'. $extension;
		 
					// Si c'est OK, on teste l'upload
					if(move_uploaded_file($_FILES['image']['tmp_name'], TARGET.$nomImage))
					{
					  $message = 'Update réussi !';
					  
					  $req = $db->prepare('UPDATE tblmembres SET image=:image WHERE id='.$_SESSION['id']);
					  $req->execute(array(
						'image' => $nomImage));
					  
					}
					else
					{
					  // Sinon on affiche une erreur systeme
					  $erreur = 'Problème lors de l\'update !';
					}
				  }
				  else
				  {
					$erreur = 'Une erreur interne a empêché l\'uplaod de l\'image';
				  }
				}
				else
				{
				  // Sinon erreur sur les dimensions et taille de l'image
				  $erreur = 'Erreur dans les dimensions de l\'image !';
				}
			  }
			  else
			  {
				// Sinon erreur sur le type de l'image
				$erreur = 'Le fichier à uploader n\'est pas une image !';
			  }
			}
			else
			{
			  // Sinon on affiche une erreur pour l'extension
			  $erreur = 'L\'extension du fichier est incorrecte !';
			}
		  }
		  else
		  {
			// Sinon on affiche une erreur pour le champ vide
			$erreur = 'Veuillez remplir le formulaire svp !';
		  }
		}
		

		
}

}

	if($idUser != "") {
	
	$res = $db->query('SELECT id,pseudo,email,date_inscription FROM tblmembres WHERE id='.$idUser);
	
	$resultat = $res->fetch();
	
	} else {
		$resultat = false;
	}
	
	if(!$resultat) {
		echo '<h1>Pas de profile</h1>';
		
	} else {
		
		$res = $db->query('SELECT id,pseudo,email,image,date_inscription FROM tblmembres WHERE id='.$idUser);

		$res->setFetchMode(PDO::FETCH_OBJ);	
	
		
		
		?>
		
		<div id="profile">
			
				<?php
				while ($user = $res->fetch()) {
					
					
					echo '<div>';
					
					if($_SESSION['id'] == $idUser) {
						if($user->image == null) {
							
							echo '<img id="run" src="images/bangkok.jpg" alt="Bangkok" title="Bangkok" />';
							
						} else {
							
							echo '<img id="run" src="images/profiles/'.$user->image.'" alt="'.$user->image.'" title="'.$user->image.'" />';
						}
						
					} else {
						if($user->image == null) {
							
							echo '<img src="images/bangkok.jpg" alt="Bangkok" title="Bangkok" />';
							
						} else {
							
							echo '<img src="images/profiles/'.$user->image.'" alt="'.$user->image.'" title="'.$user->image.'" />';
						}
						
					}
					
					echo '</div>';
					
					echo '<div>';
					
					
					if($_SESSION['id'] == $idUser) {
					
					echo '<form method="POST" action="" class="form_profile">';
					
						echo '<input type="text" name="pseudo" value="'.$user->pseudo.'" />';
					
						echo '<input type="text" name="email" value="'.$user->email.'" />';
						
						echo '<input type="hidden" name="action" value="UpdateProfile" />';
						
						echo '<input type="submit" value="Update"/>';
						
					echo '</form>';	
					
					} else {
						echo '<p><b>'.$user->pseudo.'</b></p>';
						echo '<p>'.$user->email.'</p>';
					}
					echo '<p> Date d\'inscription : '.$user->date_inscription.'</p>';
					
					if(isset($message)) {
					
						echo '<p style="color:green">'.$message.'</p>';
					}
					
					if(isset($erreur)){
							
							echo '<p style="color:red">'.$erreur.'</p>';
					}
						
					
					echo '</div>';					
				}
					
			
				?>
			
			
		</div>
		
		
		<div id="background"></div>
		<div id="modalWindow">
			<div class="exit">&#x2715;</div>
			<div id="profile_image">
				
				<h2>Modifier l'image : </h2>
				
				<form method="POST" action="" enctype="multipart/form-data">
				
					<input type="file" name="image" />
					
					<input type="hidden" name="action" value="UploadImage" />
					
					<input type="submit" value="Envoyer" />
				</form>
			
			</div> 
		</div>
		
		
		
		<?php
		
		
		
	}
	
} else {
	
	echo '<h1>Pas de profile</h1>';
	
}




?>