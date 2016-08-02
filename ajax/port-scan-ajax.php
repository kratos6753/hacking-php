<?php

error_reporting(E_ALL);

$ip = $_POST['ipaddress'];
$start = (int) $_POST['port-start'];
$end = (int) $_POST['port-end'];

if(!isset($_POST['ipaddress']) || !isset($_POST['port-start']) || !isset($_POST['port-end'])) {
	echo "Incomplete Information";
} else if(!filter_var($ip, FILTER_VALIDATE_IP)) {
	echo "Invalid IP";
} else if(!filter_var($start, FILTER_VALIDATE_INT) || ($start < 0  || $start > 65535)) {
	echo "Invalid Starting Port number";
} else if(!filter_var($end, FILTER_VALIDATE_INT) || ($end < 0  || $end > 65535)) {
	echo "Invalid Ending Port number";
} else {
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	if($socket) {
		$conn = socket_connect($socket, $ip, $start);
		if($conn) {
			die('socket connection working');
		}
	};
	$result = "";
	$open_port_count = 0;
	foreach(range($start, $end) as $port) {
		$conn = socket_connect($socket, $ip, $port);
		if($conn) {
			$open_port_count++;
			$result += "Port {$port} is open <br>";
			socket_close($socket);
			$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		}
	}
	$total_port_scanned = $end - $start + 1;
	$result = "Total {$open_port_count} ports open out of {$total_port_scanned} <br>" + $result;
	echo $result;
}

