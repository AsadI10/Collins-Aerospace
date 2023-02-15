<?php
if(session_status() === PHP_SESSION_NONE){
	session_start();
}

// Auto timeout
$currentTime = time();

if(isset($_SESSION["LastSessionAccessTime"])){
	$deltaTime = $currentTime - $_SESSION["LastSessionAccessTime"];
	// Timeout time in seconds
	if($deltaTime > 3600){
		header("Location: ./Logout.php");
	}
}
$_SESSION["LastSessionAccessTime"] = $currentTime;

?>