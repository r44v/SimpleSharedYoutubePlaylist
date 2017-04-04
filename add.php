<?php
$file = "playlist.txt";
if (isset($_POST['url'])) {
	file_put_contents($file, file_get_contents($file).PHP_EOL.$_POST['url']);
	echo "added: ".$_POST['url'];
	}
?>
<!DOCTYPE html>
<html>
<body>

<form action="add.php" method="post" enctype="application/x-www-form-urlencoded">
	youtube url:<br>
  <input type="text" name="url">
  <br>
  <input type="submit" value="Submit">
</form> 
<hr />
<a href="list.php" target="_blank">View playlist</a>
</body>
</html>
