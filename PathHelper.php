<?php
	function GetRelativeRoot(){
		$CurrentDir = $_SERVER["PHP_SELF"];
		echo $CurrentDir;
		$Count = substr_count($CurrentDir,"/");
		$arr = array();
		for($i = 0; $i < $Count-1;){
			arr_push($arr,"..");
		}
		$result = join("/",$arr);
		return $result;
	}
?>