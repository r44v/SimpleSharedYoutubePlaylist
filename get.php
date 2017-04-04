<?php
$file = "playlist.txt";

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

if (isset($_GET['count'])) {
	$urls = file($file);
	if ($_GET['count'] >= count($urls)) {
		echo "0";
	} else {
		$url = $urls[$_GET['count']];
		echo getIdFromUrl($url);
	}
} else {
	echo "wut";
}