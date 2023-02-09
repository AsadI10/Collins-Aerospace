<?php

class CacheDB extends SQLite3{

    function __construct(){
        $this->open("./Cache.db");
    }

    public function init(){
        $this->exec('CREATE TABLE IF NOT EXISTS Products(Product_id STRING, Product_Name String, Centre TEXT, LastAccessed INT, LastUpdated INT)');
    }

    // Returns the raw stored form of a Product
    public function GetProduct($productid){
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

    public function CacheProduct($product){
        $this->exec("INSERT INTO Products VALUES('".$product->GetIdentifer()."','".$product->GetName()."','".$product->GetCentre()."','".$product->GetDateCreated()."','0')");
    }
}
?>