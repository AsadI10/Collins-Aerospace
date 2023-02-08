<?php

class CacheDB extends SQLite3{

    function __construct(){
        $this->open("./Cache.db");
        $this->init();
    }

    private function init(){
        $this->exec('CREATE TABLE IF NOT EXISTS Products(Product_id STRING, Product_Name String, Center TEXT, Footprint TEXT)');
    }

    public function LoadProduct($productid){
        $sql = "SELECT * FROM Products WHERE Product_id = :pid";
        $stmt = $this->prepare($sql);
        $stmt->bindParam(':pid', $productid);
        $result = $stmt->execute();

        $splitResults = array();
        while($row = $result->fetchArray()){
            array_push($splitResults,$row);
        }

        return $splitResults;
    }

}

?>