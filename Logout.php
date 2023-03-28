<?php
	require_once("./SessionMaster.php");
	//Directs user to login page once session has been destroyed
	session_destroy();
	header("Location: ./index.php");
?>