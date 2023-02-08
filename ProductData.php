<?php
	// Path to the SQLite database for caching.
	const SQL_FILE = "./Cache.db";

	class ProductData implements \JsonSerializable
	{
		// ======
		// Fields
		// ======
		private $_Identifier;

		public $Name;
		// Coordinates of the center of this product
		public $Center;
		// Date in ms from
		public $DateCreated;

		// =========
		// Functions
		// =========

		function __construct($identifier){
			$this->_Identifier;
		}
		
		// Returns the identifier of this product.
		public function GetIdentifer(){
			return $this->_Identifier;
		}

		// Fetches a ProductData object that has been cached in the SQLite database.
		public static function LoadFromCache($identifier){
			$handle = new SQLite3(SQL_FILE);
			// If not found, return null
			return null;
		}

		// Saves this object into the SQLite database.
		// Updates an existing record or creates a new record if one doesn't exist already.
		public function SaveToCache(){
			$handle = new SQLite3(SQL_FILE);
		}


		public function jsonSerialize()
		{
			$vars = get_object_vars($this);

			return $vars;
		}
	}
?>