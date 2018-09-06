<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
</head>

<body>
	
	<h1>POST-IT HEAVEN</h1>
	
	<form action="docreatepostit.php" method="post">
		<input type="text" name="author" placeholder="Forfatternavn">
		<input type="text" name="headertext" placeholder="Overskrift">
		<input type="text" name="bodytext" placeholder="Brødtekst">
		
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
// Radio button example:
// echo '<input type="radio" name="colorid" value="'.$cid.'"> '.$cnam.'<br>'; 
			}
?>
		</select>
		
		
		<button type="submit" class="button1">Opret</button>
	</form>
	
<hr>	
	<div class="board">
<?php

	require_once('dbcon.php');
	$sql = 'SELECT postit.id, createdate, author, headertext, bodytext, cssclass FROM postit, color WHERE color_id=color.id';
	
	$stmt = $link->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($pid, $createdate, $author, $htext, $btext, $cssclass);
	
	while($stmt->fetch()){ 
?>
	<div class="<?=$cssclass?>">
		<div class="postit">
			<div class="ef">
				<time><?=$createdate?></time>
				<h2><?=$htext?></h2>
				<p><?=$btext?></p>
				<p class="name">&copy;<?=$author?></p>
			
				<form class="delete" action="dodeletepostit.php" method="post">
					<input type="hidden" name="pid" value="<?=$pid?>">
					<input type="image" src="delbutton.png" alt="Delete">
				</form>
			</div>
		</div>
	</div>

<?php	
	}
?>

</div>
</body>
</html>