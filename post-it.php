<?php
session_start();
require_once('util.php');
?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Post-it</title>
<link href="style.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
</head>

<body>
	<div class="body">
		<?php 
	$cmd = $_POST['cmd'] ?? null;
	
	switch ($cmd){
		case 'createuser':
			$un = filter_input(INPUT_POST, 'un') or die('Missing or illegal un parameter');	
			$pw = filter_input(INPUT_POST, 'pw') or die('Missing or illegal pw parameter');	
			if (createUser($un, $pw) > 0){
				loginUser($un, $pw);
			}
			else {
				echo 'unable to create user - username already exists';
			}
			break;
		case 'login':
			echo 'checklogin';
			$un = filter_input(INPUT_POST, 'un') or die('Missing or illegal un parameter');	
			$pw = filter_input(INPUT_POST, 'pw') or die('Missing or illegal pw parameter');	
			loginUser($un, $pw);
			break;
		case 'logout':
			logoutUser();
			break;
		default:
			// ignore
	}
	
?>
	
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">	
<?php
	if (isset($_SESSION['uid'])){ ?>

		Logged in as <?=$_SESSION['uname']?>
		<button class="submit" type="submit" name="cmd" value="logout">Logout</button>
<?php } else header('location: index.php'); 
?>
			
</form>

	<div class="form">
	<form action="docreatepostit.php" method="post">
		<h1>Make your own post-it</h1>
		<h4>Please fill out your postit here</h4>
		<input type="hidden" name="users_id" value="<?=$_SESSION['uid']?>">
		<label class="one">
		<input class="hey" type="text" name="author" placeholder="Forfatternavn">
		</label>
		<label class="two">
		<input class="hey" type="text" name="headertext" placeholder="Overskrift">
		</label>
		<label class="three">
		<textarea type="text" name="bodytext" placeholder="Brødtekst">

		</textarea> 
		</label>
		
		<label class="four">
		Farve:
		<select name="colorid" required>
		<?php
			require_once('dbcon.php');
			$sql = 'SELECT id, colorname FROM color';
			$stmt = $link->prepare($sql);
			$stmt->execute();
			$stmt->bind_result($cid, $cnam);

			while($stmt->fetch()){
				echo '<option value="'.$cid.'">'.$cnam.'</option>'.PHP_EOL;
			}
		?>
		</select>
		</label>
	
		<button type="submit" class="submit1">Create new</button>
	</form>
		</div>
		<br>
	<div class="board">
<?php
	require_once('dbcon.php');
	$uid = $_SESSION["uid"];
	$admin = $_SESSION["admin"];

	if ($admin) {
		$sql = "SELECT postit.id, createdate, author, headertext, bodytext, cssclass FROM postit, color where color_id=color.id";
	}
	else
		$sql = "SELECT postit.id, createdate, author, headertext, bodytext, cssclass FROM postit, color where color_id=color.id and users_id=$uid";

	$stmt = $link->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($pid, $createdate, $author, $htext, $btext, $cssclass);
	
	while($stmt->fetch()){ 
?>
	<div class="<?=$cssclass?>">
			<div class="ef">
				<time><?=$createdate?></time>
				<h2><?=$htext?></h2>
				<p><?=$btext?></p>
				<p class="name">&copy;<?=$author?></p>
			
				<form class="delete" action="dodeletepostit.php" method="post">
					<input type="hidden" name="pid" value="<?=$pid?>">
					<input type="image" src="images/delbutton.png" alt="Delete">
				</form>
			</div>
	</div>


<?php	
	}
?>
</div>
</div>
</body>
</html>