<?php
session_start();
require 'database.php';
$yourid = $_SESSION["userid"];

$storyid = $_GET["storyid"];

$sql = "DELETE FROM story where id='$storyid'";

$result = $conn -> query($sql);
$conn -> close();

header("Location: storyindex.php");
?>
