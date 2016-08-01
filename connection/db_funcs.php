<?php

require_once 'db.php';

/**
 * Checks if user already exists
 * If exists returns row or else returns false
 */

function check_user_if_already_exists($ipaddress) {
	global $dbh;
	$query = "SELECT * FROM visitors WHERE ipaddress = '{$ipaddress}'";
	$row = $dbh->query($query, PDO::FETCH_ASSOC);
	return $row->fetch(PDO::FETCH_OBJ);
}

/**
 * Gives the last time the user visited
 */

function last_time_visited($row) {
	return $row->visited_at;
}

/**
 * Create a new visit
 */

function save_visit($ip) {
	global $dbh;
	$ipaddress = $ip;
	$time_now = date('Y-m-d G:i:s');
	if(!$ipaddress) return false;
	$query = "INSERT INTO visitors (ipaddress, visited_at) VALUES (?, ?)";
	$query = $dbh->prepare($query);
	return $query->execute(array($ipaddress, $time_now));
}

/**
 * Update the current visit
 */

function update_visit($user) {
	global $dbh;
	$time_now = date('Y-m-d G:i:s');
	$user_id = $user->id;
	$query = "UPDATE visitors SET visited_at = ? WHERE id = ?";
	$query = $dbh->prepare($query);
	return $query->execute(array($time_now, $user_id));
}