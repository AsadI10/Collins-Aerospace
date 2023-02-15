<?php
	require_once("./SessionMaster.php");
	session_destroy();
	header("Location: ./index.php");
?>