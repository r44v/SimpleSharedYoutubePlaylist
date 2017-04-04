<?php
set_time_limit(0);
$file = "playlist.txt";
$saved = "titles.txt";

function getIdFromUrl($url) {
	$url = str_replace(PHP_EOL, "", $url);
	$query = parse_url($url, PHP_URL_QUERY);
	parse_str($query, $result);
	if (array_key_exists("v", $result)) {
		return $result['v'];
	} else {
		return "0";
	}
}

 function get_youtube($url){

 $youtube = "http://www.youtube.com/oembed?url=". $url ."&format=json";

 $curl = curl_init($youtube);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 $return = curl_exec($curl);
 curl_close($curl);
 return json_decode($return, true);

 }

$items = file($saved);
$amount = count($items);
$urls = file($file);
$count = 0;
foreach ($urls as $url) {
	if ($count >= $amount) {
		sleep(2);
		$url = str_replace(PHP_EOL, "", $url);
		$json_line = json_encode(array(
			'count' => $count,
			'url'	=> $url,
			'title' => get_youtube($url)['title']
		));
		file_put_contents($saved, $json_line.PHP_EOL, FILE_APPEND | LOCK_EX);
	}
	$count++;	
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Playlist</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Playlist</h2>
  <p>Easy simple working:</p>            
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Count</th>
        <th>Title</th>
        <th>Utl</th>
      </tr>
    </thead>
    <tbody>
	<?php
	$items = file($saved);
foreach ($items as $item) {
	$item = str_replace(PHP_EOL, "", $item);
	$item = json_decode($item, true);
	echo "<tr><td>".$item['count']."</td><td>".$item['title']."</td><td>".$item['url']."</td></tr>";
	echo PHP_EOL;
}
	?>
    </tbody>
  </table>
</div>

</body>
</html>

