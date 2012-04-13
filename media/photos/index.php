<?php
$str = $_SERVER['HTTP_HOST'];
$url = $_SERVER['SCRIPT_FILENAME'];
$ROOT = substr($url, 0, strpos($url, "Athletics/Mens_Ultimate") + 24); //This is a hack to find the root directory on the filesystem so we can point to stuff correctly.
require_once($ROOT.'controllers.php');
//The following lines are another hack to determine the URL parameters, e.g. if the URL is http://brown.edu/Athletics/Mens_Ultimate/foo/bar then $params will be [foo, bar]
$params = array_slice(explode("/", $_SERVER['REQUEST_URI']), 1);
if ($params[sizeof($params)-1] == "" || $params[sizeof($params)-1] == "index.php") {
    $params = array_slice($params, 0, sizeof($params)-1);
}
$params = array_slice($params, 2, sizeof($params));
if (sizeof($params) == 0) {
    $currlink = "home";
}
else {
    $currlink = $params[0];
}
require_once($ROOT.'header.php');
echo "<div id='content'>";
render_content($params);
echo "</div>";
require_once($ROOT.'footer.php');
?>