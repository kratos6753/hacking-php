<?php

$user = 'root';
$password = 'root';

try {
	$dbh = new PDO('mysql:host=localhost;dbname=hacking-php', $user, $password);
} catch(PDOException $e) {
	print "Error: ".$e->getMessage()."<br>";
	die();
}
