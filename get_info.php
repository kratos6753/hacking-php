<?php

require_once 'connection/db_funcs.php';
require_once 'lib/functions.php';

if(!isset($_COOKIE['visited'])) {
	setcookie('visited', 1, time()+3600);
	$ipaddress = get_client_ip();
	if($user = check_user_if_already_exists($ipaddress)) {
		// User already visited the website
		update_visit();
	} else {
		// New user
		save_visit();
	}
} else {
	echo 'Already visited!'.PHP_EOL;
}