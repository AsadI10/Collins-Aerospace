<?php
	class ProductData
	{
		private $_Identifier;

		function __construct($identifier){
			$this->_Identifier;
		}
		
		public function GetIdentifer(){
			return $this->_Identifier;
		}

		public static function LoadFromCache($identifier){

		}
		public function SaveToCache(){

		}
	}
?>