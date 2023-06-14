<?php
require 'includes/connection.php';
session_start();

if (isset($_POST['register'])) {
	$lastname = $_POST['lastname'];
	$firstname = $_POST['firstname'];
	$email = $_POST['email'];
	$password = $_POST['password'];

	var_dump("------->" . $lastname . " " . $firstname . " " . $email . " " . $password);
	var_dump(isset($_POST['register']));
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
				<br />
				<div>
					<button name="register">Register</button>
				</div>
				<a href="index.php">Login</a>
			</form>
		</div>
	</div>
</body>

</html>