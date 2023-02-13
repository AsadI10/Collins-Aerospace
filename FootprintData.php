<?php
class FootprintData{
	public $Type;
	public $Coordinates;

	function __construct($type, $coordinateArr){
		$this->Type = $type;
		$this->Coordinates = $coordinateArr;
	}
}
?>