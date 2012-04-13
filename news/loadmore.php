<?php
if(isset($_GET['start'])) {
	require_once("getposts.php");
	/* spit out the posts within the desired range */
	echo loadPosts($_GET['start'],$_GET['desiredPosts']);
	/* save the user's "spot", so to speak */
	$_SESSION['posts_start']+= $_GET['desiredPosts'];
	/* kill the page */
	die();
}
?>