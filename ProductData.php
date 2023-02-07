<?php
	const SQL_FILE = "./cache.sql";

	class ProductData
	{
		private $_Identifier;
		public $Center;
		public $DateCreated;

		function __construct($identifier){
			$this->_Identifier;
		}
		
		public function GetIdentifer(){
			return $this->_Identifier;
		}

		public static function LoadFromCache($identifier){

		}

		public function SaveToCache(){
			$handle = new SQLite3(SQL_FILE);#

			$sql = "UPDATE ProductData"
		}
	}
?>