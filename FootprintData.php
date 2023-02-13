<?php
class FootprintData{
	// How the coordinates should be interprited
	// Such as: Polygon, LineString
	public $Type;
	// For a Polygon, this is an array of polygons, where polygons are an array of coordinates
	// Example:[[[0,0], [0,1]], [[2,3], [4,5]]]

	// For a LineString, this is an array of coordinates
	// Example: [[0,1], [1,2], [3,4]]
	public $Coordinates;

	function __construct($type, $coordinateArr){
		$this->Type = $type;
		$this->Coordinates = $coordinateArr;
	}
}
?>