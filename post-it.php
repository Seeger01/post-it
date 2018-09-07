<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
</head>

<body>
	<div class="body">
	<div class="form">
	<form action="docreatepostit.php" method="post">
		<h1>Post-it heaven</h1>
		<h4>please fill out your postit here</h4>
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
	
		<button type="submit" class="button1">Create new</button>
	</form>
		</div>
		<br>
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