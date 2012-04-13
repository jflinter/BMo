<?php
$str = $_SERVER['HTTP_HOST'];
$url = $_SERVER['SCRIPT_FILENAME'];
$ROOT = substr($url, 0, strpos($url, "Athletics/Mens_Ultimate") + 24); //This is a hack to find the root directory on the filesystem so we can point to stuff correctly.
$site_constants = array();
$db = new PDO('sqlite:'.$ROOT.'admin/database.db');
$result = $db->query("select * from site_constants");
foreach($result as $row) {
    $site_constants[$row['key']] = $row['value'];
}
$db = NULL;

?>