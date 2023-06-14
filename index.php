<?php
require 'includes/connection.php';
session_start();

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
		<h3>Login</h3>
		<div></div>
		<div>
			<form method="POST">
				<h4>Login here...</h4>
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
					<button type="submit">Login</button>
				</div>
				<a href="registration.php">Registration</a>
			</form>
		</div>
	</div>
</body>

</html>