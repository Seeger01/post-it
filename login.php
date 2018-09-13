<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
</head>

<body>
	
<?php
	session_start();
	
	$un = filter_input(INPUT_POST, 'un') or die('Missing or illegal un parameter');	
	$pw = filter_input(INPUT_POST, 'pw') or die('Missing or illegal pw parameter');	
	
	
	require_once('dbcon.php');
	
	$sql = 'SELECT id, pwhash, admin FROM users WHERE username=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($id, $pwhash, $admin);
	
	while ($stmt->fetch()){	}
	
	if (password_verify($pw,$pwhash)){
		$_SESSION['uid'] = $id;
		$_SESSION['uname'] = $un;
		$_SESSION['admin'] = $admin;
		header( 'Location: post-it.php?$id' );
	}
	else{
		echo 'Illegal username/password combination';
	}
	
	
?>
</body>
</html>