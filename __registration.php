 <?php
	// Ce fichier enregistre un utilisateur sur la base de données
	// Ce fichier enregistre un utilisateur sur la base de données
	// On se connecte à la base de données

	$tableau = [];
	require 'includes/connection.php';

	// On vérifie si les champs sont vides

	if (!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['gpdr'])) {
		$lastname = $_POST['lastname'];
		$firstname = $_POST['firstname'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$gpdr = $_POST['gpdr'];


		if (!preg_match('/[A-Z]/', $password)) {
			$tableau[] = 'Le mot de passe doit contenir au moins une lettre majuscule (Uppercase missing).';
		}

		if (!preg_match('/[0-9]/', $password)) {
			$tableau[] = 'Le mot de passe doit contenir au moins un chiffre (Number missing).';
		}

		if (!preg_match('/[!@#$%^&*]/', $password)) {
			$tableau[] = 'Le mot de passe doit contenir au moins un caractère spécial (Special char missing).';
		}

		if (strlen($password) < 16) {
			$tableau[] = 'Le mot de passe est trop court, il doit contenir au moins 16 caractères (Too short, password must be at least 16 characters long).';
		}

		if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
			$tableau[] = "l'adresse email est incorrecte";

		}

	    
		if (empty($tableau)){
			
			$pseudo = strip_tags($_POST["lastname"]);
			$pseudo = strip_tags($_POST["firstname"]);
			$pseudo = strip_tags($_POST["email"]);
			$pseudo = strip_tags($_POST["password"]);
	
			$hash = password_hash($password, PASSWORD_ARGON2ID);
			
			$sql = "INSERT INTO  `advisors` (`lastname`, `firstname`, `email`, `password`, `gpdr`) VALUES (:lastname, :firstname, :email, :hash, :gpdr)";
			$query = $db->prepare($sql);
	
	
			$query->bindValue(':lastname', $lastname, PDO::PARAM_STR);
			$query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
			$query->bindValue(':email', $email, PDO::PARAM_STR);
			$query->bindValue(':hash', $hash, PDO::PARAM_STR);
			$query->bindValue(':gpdr', $gpdr, PDO::PARAM_BOOL);
	
			$query->execute();

		}
	
		
	}


	?>


 <!DOCTYPE html>
 <html lang="fr">

 <head>
 	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
 	<title>Tableau de bord :</title>
 	<link rel="icon" type="image/x-icon" href="icons/favicon.png">
 	<link rel="preconnect" href="https://fonts.googleapis.com">
 	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 	<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;400;700&display=swap" rel="stylesheet">
 	<link rel="stylesheet" href="css/styles.min.css">

 </head>

 <body>
 	<nav>
 		<div>
 			<a href=""><svg height="50" width="50">
 					<circle cx="50" cy="50" r="40" stroke="#333" stroke-width="3" fill="#fff" />
 				</svg> FMC Parisud</a>
 		</div>
 	</nav>
 	<div>
 		<div></div>
 		<h3>INSCRIPTION</h3>
 		<div>
 			<form method="POST" id="registerForm">

 				<div class="error-messages"></div>

 				<div>
 					<label>Nom :</label>
 					<input type="text" name="lastname" autocomplete="off" />
 				</div>
 				<div>
 					<label>Prénom :</label>
 					<input type="text" name="firstname" autocomplete="off" />
 				</div>
 				<div>
 					<label>Email :</label>
 					<input type="email" name="email" autocomplete="off" />
 				</div>
 				<div>
 					<label>Mot de Passe :</label>
 					<input type="password" name="password" id="register-password" autocomplete="off" />
 				</div>
 				<label>
 					<input type="checkbox" value="1" name="gpdr"> J'accepte la collecte de mes données dans le cadre du RGPD.
 				</label>
 				<div><span id="errorSpan"></span></div>
 				<div>
 					<button type="submit">M'inscrire</button>
 				</div>
 				<a href="index.php">Me connecter</a>
 			</form>
 		</div>
 	</div>
 </body>

 </html>