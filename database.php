<?php
$conn = new mysqli('localhost', 'module3', 'module3', 'module3');

if($conn->connect_errno) {
	printf("Connection Failed: %s\n", $conn->connect_error);
	exit;
}
?>