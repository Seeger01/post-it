<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
</head>

<body>
	<div id="first">
	<form action="createuser.php" method="post">
		<h1>Create User</h1>
			<label class="loglabel">Username</label>
			<input class="uname" type="text" name="un" placeholder="Username" required>
			<label class="loglabel" >Password</label>
			<input class="pass" type="password" name="pw" placeholder="Password" required>
			<button class="submit" type="submit">Opret</button>
	</form>

	<form action="login.php" method="post">
		
			<h1>Login</h1>
			<label class="loglabel" >Username</label>
			<input class="uname" type="text" name="un" placeholder="Username" required>
			<label class="loglabel">Password</label>
			<input class="pass" type="password" name="pw" placeholder="Password" required>
			<button class="submit" type="submit">Login</button>
		

	</form>
	</div>	
	

</body>
</html>