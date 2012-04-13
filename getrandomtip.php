<?php
	$url = $_SERVER['SCRIPT_FILENAME'];
	$ROOT = substr($url, 0, strpos($url, "Athletics/Mens_Ultimate") + 24); //This is a hack to find the root directory on the filesystem so we can point to stuff correctly.
	$db = new PDO('sqlite:'.$ROOT.'admin/database.db');
	$result = $db->query("select * from zipstips ORDER BY RANDOM() LIMIT 1")->fetchAll(PDO::FETCH_ASSOC);
	$result[0]["date"] = date("n/j/y", $result[0]["date"]);
	echo json_encode($result[0]);
?>