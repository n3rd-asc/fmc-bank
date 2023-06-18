<?php
// Ce fichier enregistre un utilisateur sur la base de données

// On se connecte à la base de données
require 'includes/connection.php';

// On vérifie si les champs sont vides
if (!empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['gpdr'])) {
	$lastname = $_POST['lastname'];
	$firstname = $_POST['firstname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$gpdr = $_POST['gpdr'];

	// Vérification des critères du mot de passe
	if (!preg_match('/[A-Z]/', $password)) {
		echo 'Le mot de passe doit contenir au moins une lettre majuscule (Uppercase missing).';
		exit();
	}

	if (!preg_match('/[0-9]/', $password)) {
		echo 'Le mot de passe doit contenir au moins un chiffre (Number missing).';
		exit();
	}

	if (!preg_match('/[!@#$%^&*]/', $password)) {
		echo 'Le mot de passe doit contenir au moins un caractère spécial (Special char missing).';
		exit();
	}

	if (strlen($password) < 16) {
		echo 'Le mot de passe est trop court, il doit contenir au moins 16 caractères (Too short, password must be at least 16 characters long).';
		exit();
	}

	// On hash le mot de passe
	$hash = password_hash($password, PASSWORD_ARGON2ID);

	// On écrit le SQL pour créer un nouveau conseiller
	$sql = "INSERT INTO  `advisors` (`lastname`, `firstname`, `email`, `password`, `gpdr`) VALUES (:lastname, :firstname, :email, :hash, :gpdr)";

	// prepare
	$query = $db->prepare($sql);

	// bind
	$query->bindValue(':lastname', $lastname, PDO::PARAM_STR);
	$query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
	$query->bindValue(':email', $email, PDO::PARAM_STR);
	$query->bindValue(':hash', $hash, PDO::PARAM_STR);
	$query->bindValue(':gpdr', $gpdr, PDO::PARAM_BOOL);

	// execute
	$query->execute();

	// Créer une session pour l'utilisateur
	session_start();

	$_SESSION['email'] = $email; // utiliser l'e-mail comme identifiant

	// Rediriger vers home.php
	header('Location: home.php');
	exit();
} else {
	// Erreur
	if (!empty($_POST)) {
		echo "Veuillez remplir tous les champs obligatoires et accepter les conditions.";
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
	<script src="js/validation.js" defer></script>

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
				<div>
					<label>Nom :</label>
					<input type="text" name="lastname" />
				</div>
				<div>
					<label>Prénom :</label>
					<input type="text" name="firstname" />
				</div>
				<div>
					<label>Email :</label>
					<input type="email" name="email" />
				</div>
				<div>
					<label>Mot de Passe :</label>
					<input type="password" name="password" id="register-password" />
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