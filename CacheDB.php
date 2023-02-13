<?php

class CacheDB{

    private $path;

    function __construct(){
        $this->path = "./Cache.db";
        $this->_Init();
    }


    private function _Init(){
        $db = new Sqlite3($this->path);
        $db->exec('CREATE TABLE IF NOT EXISTS Products(Product_id STRING, Product_Name STRING, Centre TEXT, Date_Created TEXT, Date_Modified TEXT, Product_URL TEXT, LastAccessed INT, LastUpdated INT, UNIQUE(Product_id))');
        //$db->exec('CREATE UNIQUE INDEX Products_Product_id on Products(Product_id)');
        $db->close();
    }

    // Returns the raw stored form of a Product
    public function GetProduct($productid){
        $db = new Sqlite3($this->path);
        $sql = "SELECT * FROM Products WHERE Product_id = :pid";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':pid', $productid);
        $result = $stmt->execute();

        $record = $result->fetchArray(SQLITE3_ASSOC);

        // If record is old, return null

        // Otherwise, update LastAccessed

        // There should be only 1, so return it
        return $record;

    }

    public function CacheProduct($product){
        $db = new Sqlite3($this->path);
        $db->exec("INSERT OR IGNORE INTO Products VALUES('"
        .$product->GetIdentifer()."','"
        .$product->GetName()."','"
        .$product->GetCentre()."','"
        .$product->DateCreated."','"
        .$product->DateModified."','"
        .$product->ProductURL."','"
        ."'0'"."','"
        ."'0'".")"
        );
        $db->close();
    }
}
?>