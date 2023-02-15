<?php
	require_once("./SessionMaster.php");
	function RaiseFatalError($sender, $message){
		header("Location: ./ErrorHandler.php?ErrorSender='".$sender."'&ErrorMessage='".$message."'");
	}
	if(basename($_SERVER['PHP_SELF']) == "ErrorHandler.php"){
		if(isset($_GET["ErrorSender"]) && isset($_GET["ErrorMessage"])){
			?>
			<h1>Fatal Error Raised</h1>
			Sender: <?php echo $_GET["ErrorSender"]; ?><br>
			Message: <?php echo $_GET["ErrorMessage"]; ?><br>
			<a href="index.php">Return to home page</a>
			<?php
			exit();
		}
		else{
			header("Location: ./index.php");
		}
	}

?>