<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
	
	
<?php
	
$author = filter_input(INPUT_POST, 'author') or die('Missing author parameter');	
$headertext = filter_input(INPUT_POST, 'headertext') or die('Missing headertext parameter');	
$bodytext = filter_input(INPUT_POST, 'bodytext') or die('Missing bodytext parameter');	
$colorid = filter_input(INPUT_POST, 'colorid') or die('Missing colorid parameter');	
$users_id = filter_input(INPUT_POST, 'users_id');


	require_once('dbcon.php');
	
	$sql = 'INSERT INTO postit (author, headertext, bodytext, color_id, users_id) VALUES (?, ?, ?, ?, ?)';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('sssii', $author, $headertext, $bodytext, $colorid, $users_id);
	$stmt->execute();
	
	echo 'Inserted '.$stmt->affected_rows.' new rows in the table';
	header( 'Location: post-it.php');	
?>
	
</body>
</html>