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

	// On hash le mot de passe
	// password_hash($password, PASSWORD_ARGON2ID);

	// On écrit le SQL pour créer un nouveau conseiller
	$sql = "INSERT INTO  `advisors` (`lastname`, `firstname`, `email`, `password`, `gpdr`, `created_at`) VALUES (:lastname, :firstname, :email, :password, :gpdr, NOW())";

	// prepare
	$query = $db->prepare($sql);

	// bind
	$query->bindValue(':lastname', $lastname, PDO::PARAM_STR);
	$query->bindValue(':firstname', $firstname, PDO::PARAM_STR);
	$query->bindValue(':email', $email, PDO::PARAM_STR);
	$query->bindValue(':password', $password, PDO::PARAM_STR);
	$query->bindValue(':gpdr', $gpdr, PDO::PARAM_BOOL);

	// execute
	$query->execute();

	// Rediriger vers index.php
	header('Location: index.php');
} else {
	// Erreur
	echo "Veuillez remplir tous les champs obligatoires et accepter les conditions.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
	<nav>
		<div>
			<a href="">FMC Bank</a>
		</div>
	</nav>
	<div></div>
	<div>
		<h3>Registration</h3>
		<div></div>
		<div>
			<form method="POST">
				<h4>Register here...</h4>
				<div>
					<label>Lastname</label>
					<input type="text" name="lastname" />
				</div>
				<div>
					<label>Firstname</label>
					<input type="text" name="firstname" />
				</div>
				<div>
					<label>Email</label>
					<input type="email" name="email" />
				</div>
				<div>
					<label>Password</label>
					<input type="password" name="password" />
				</div>
				<label>
					<input type="checkbox" value="1" name="gpdr">
					gpdr check
				</label>
				<div>
					<button type="submit">Register</button>
				</div>
				<a href="index.php">Login</a>
			</form>
		</div>
	</div>
</body>

</html>