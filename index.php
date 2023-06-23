<?php
// Fichier index.php qui contient le formulaire de connexion

require 'includes/connection.php';
session_start();

$error_message = ""; // Définition de la variable $error_message avec une valeur par défaut pour afficher l'erreur

$email=$_POST ;
// On vérifie si les champs sont vides
if (!empty($_POST['email']) && !empty($_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	}

	// On écrit le SQL
	$sql = 'SELECT * FROM advisors WHERE email = :email ';
	// prepare
	$query = $db->prepare($sql);

	// bind
	$query->bindValue(':email', $email, PDO::PARAM_STR);

	// execute
	$query->execute();

	$advisor = $query->fetch(PDO::FETCH_ASSOC);

	if ($advisor && password_verify($password, $advisor['password'])) {

		// Créer une session pour l'utilisateur avec l'email comme identifiant
		$_SESSION['email'] = $advisor['email'];

		// Rediriger vers home.php
		header('Location: home.php');
		exit();

	} 


?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
	<title>Me connecter</title>
	<link rel="icon" type="image/x-icon" href="icons/favicon.png">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="./css/styles.min.css">
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
		<h3>CONNEXION</h3>
		<div>
			<form method="POST">
				<div>
					<label>Email :</label>
					<input type="email" name="email" />
				</div>
				<div>
					<label>Mot de passe :</label>
					<input type="password" name="password" />
				</div>
				<div class="errormsg"><?php echo $error_message; ?></div>
				<div>
					<button type="submit">Me connecter</button>
				</div>
				<a href="registration.php">M'enregistrer</a>
			</form>
		</div>
	</div>
</body>

</html>