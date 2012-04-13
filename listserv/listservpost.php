<?php
	if (!empty($_POST['useremail'])) {
try {
		$db = new PDO('sqlite:idiots.db');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$name = strtolower($_POST['username']);
		$email = strtolower($_POST['useremail']);
		$sql = "REPLACE INTO idiotcounts VALUES (:name, :email,
		  COALESCE(
		    (SELECT count FROM idiotcounts
		       WHERE useremail=:email),
		    0) + 1);";
		$sth = $db->prepare($sql);
		$sth->bindParam(':name', $name);
		$sth->bindParam(':email', $email);
		$sth->execute();
		}
		catch (PDOException $e) {
			print_r($e->getMessage());
		}
	}
?>