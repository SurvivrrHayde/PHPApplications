<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<title>Welcome to Connections</title>
	</head>
	<body>
		<h1>Connections</h1>
		<?php

		if (isset($_SESSION['error'])) {
			echo '<p class="error">' . $_SESSION['error'] . '</p>';
			unset($_SESSION['error']);
		}

		?>
		<form id="login-form" method="post" action="?command=login">
			<label for="name-input">Name:</label>
			<input id="name-input" type="text" name="name" />
			<label for="email-input">Email:</label>
			<input id="email-input" type="text" name="email" />
			<button type="submit">Login</button>
		</form>
	</body>
</html>
