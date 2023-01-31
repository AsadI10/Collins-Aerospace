<?php
session_start();
$data = $_SESSION["data"];

echo json_encode($_SESSION["data"]);
?>