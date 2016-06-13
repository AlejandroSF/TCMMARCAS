<!DOCTYPE html>
<html>
<?php
	session_start();
	if (isset($_SESSION['AdminPrivileges'])) {
		header('Location: index.php');
	}
?>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Login</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
	<form action="../views/adminauth.php" method="post" id="loginForm" name="loginForm">
		<input type="text" name="user" id="user" placeholder="Usuario" required>
		<input type="password" name="pass" id="pass" placeholder="Contraseña" required>
		<input type="submit">
	</form>
	<script>
		$( document ).ready(function() {
			$( "#loginForm" ).submit(function(event) {
				event.preventDefault();
				$.ajax({
					url: "../views/adminauth.php",
					data: $( "#loginForm" ).serializeArray(),
					type: "POST",
					dataType : "json",
					success: function(response) {
						alert(JSON.stringify(response));
					},
					error: function( xhr, status, errorThrown ) {
						console.log( "Error: " + errorThrown );
						console.log( "Status: " + status );
						console.dir( xhr );
					}
				});
			});
		});
	</script>
</body>
</html>