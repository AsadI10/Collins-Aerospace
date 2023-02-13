<?php
	require_once("CacheDB.php");

	class ProductData implements \JsonSerializable
	{
		// ======
		// Fields
		// ======
		private $Identifier;
		private $Name;
		// Coordinates of the center of this product
		private $Centre;
		
		public $DocumentType;
		public $DateCreated;
		public $DateModified;
		// Footprint data object
		public $Footprint;
		public $ProductURL;
		public $Thumbnail;
		public $MissionID;


		// =========
		// Functions
		// =========
  
		function __construct($identifier, $name, $centre){
			$this->Identifier = $identifier;
			$this->Name = $name;
			$this->Centre = $centre;
		}
		
		// Returns the identifier of this product.
		public function GetIdentifer(){
			return $this->Identifier;
		}

		public function GetName(){
			return $this->Name;
		}

		public function GetCentre(){
			return $this->Centre;
		}

		// Fetches a ProductData object that has been cached in the SQLite database.
		public static function Load($identifier){
			// Try and fetch from database
			$vals = $_SESSION["CacheDB"]->GetProduct($identifier);
			// If found and in date
			if($vals != null){
				// Create new object and populate it with data
				$cachedObject = new ProductData($identifier,
				$vals["Product_Name"],
				$vals["Centre"]);

				$cachedObject->DateCreated = $vals["Date_Created"];
				$cachedObject->DateModified = $vals["Date_Modified"];
				$cachedObject->ProductURL = $vals["Product_URL"];
				$cachedObject->Footprint = new FootprintData($vals["Footprint_Type"], json_decode($vals["Footprint_Coordinates"]));
				
				return $cachedObject;

			}
			// If not found in database or is old
			else
			{
				// Fetch from API
				$APIResult = $_SESSION["APIInterface"]->GetData($identifier);
				// If API returned a good result, cache it and return.
				if($APIResult != null){
					$APIResult->SaveToCache();
					return $APIResult;
				}

			}
			// If not found
			return null;
		}

		// Saves this object into the SQLite database.
		// Updates an existing record or creates a new record if one doesn't exist already.
		public function SaveToCache(){
			$_SESSION["CacheDB"]->CacheProduct($this);
		}

		public function jsonSerialize()
		{
			$vars = get_object_vars($this);

			return $vars;
		}
	}
?>