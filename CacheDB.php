<?php

class CacheDB extends SQLite3{
    
    function __construct(){
        $this->open("./Cache.db");
        $this->init();
    }

    function init(){
        $this->exec('CREATE TABLE IF NOT EXISTS Products(Product_id STRING, Product_Name String, Center TEXT, Footprint TEXT)');
    }

}

?>