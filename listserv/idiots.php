<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Listserv Removal Tool</title>
        <link rel="stylesheet" href="style.css"></link>
        <link rel="shortcut icon" href="/Athletics/Mens_Ultimate/images/favicon.ico"></link>
        <script src="/Athletics/Mens_Ultimate/javascript/jquery-1.6.min.js"></script>
		</head>
		<body>
		        <div id="title"><a href="/Athletics/Mens_Ultimate/"><img src="/Athletics/Mens_Ultimate/images/title_brownian_motion.png" alt="Brownian Motion" /></a></div>
				<div id="content">
		<h2>Top Idiots</h2>
		<h3>Welcome to the listserv removal hall of fame!</h3>
		<table>
			<tr><td>Name</td><td>Email</td><td>Removal Attempts</td><td>Removal attempt time (seconds)</td></tr>
			<?php
			$db = new PDO('sqlite:idiots.db');
			$result = $db->query("select * from idiotcounts order by count desc");
			foreach($result as $row) {
				$name = $row[0];
				$email = $row[1];
				$count = $row[2];
				$seconds = intval($count) * 25;
				echo "<tr><td>$name</td><td>$email</td><td>$count</td><td>$seconds</td></tr>";
			}
			?>
			</table>