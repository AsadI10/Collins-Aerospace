<?php
	class ProductData implements \JsonSerializable
	{
		// ======
		// Fields
		// ======
		private $_Identifier;
		// Singleton Database Object Used For DB Interaction.
		private $Database;

		public $Name;
		// Coordinates of the center of this product
		public $Center;
		// Date in ms from
		public $DateCreated;

		// =========
		// Functions
		// =========
  
		function __construct($identifier, $database){
			$this->_Identifier;
			$this->Database = $database;
		}
		
		// Returns the identifier of this product.
		public function GetIdentifer(){
			return $this->_Identifier;
		}

		// Fetches a ProductData object that has been cached in the SQLite database.
		public function LoadFromCache($identifier){
			$vals = $this->Database->loadProduct($identifier);
		}

		// Saves this object into the SQLite database.
		// Updates an existing record or creates a new record if one doesn't exist already.
		public function SaveToCache(){
		}


		public function jsonSerialize()
		{
			$vars = get_object_vars($this);

			return $vars;
		}
	}
?>