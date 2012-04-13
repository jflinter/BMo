BMo News:<br>
<?php
	$url = $_SERVER['SCRIPT_FILENAME'];
	$ROOT = substr($url, 0, strpos($url, "Athletics/Mens_Ultimate") + 24);
	require($ROOT.'constants.php');
?>
<a href="http://scores.usaultimate.org/scores/#college-open/team/1200" target="_blank">Official Scores</a> 
<a href="http://twitter.com/#!/<?php echo $site_constants['twitter_name']; ?>" target="_blank">Twitter</a>
<a href="/Athletics/Mens_Ultimate/news/newsletter">Newsletter</a>
<a href="/Athletics/Mens_Ultimate/news/schedule">Schedule</a>