<?php

class CacheDB{

    private $path;

    function __construct($databasePath){
        $this->path = $databasePath;
        $this->_Init();
    }


    private function _Init(){
        $db = new Sqlite3($this->path);

        // Create Products table to store ProductData objects
        $db->exec('CREATE TABLE IF NOT EXISTS Products(
            Product_id TEXT,
            Product_Name TEXt,
            Centre TEXT,
            Date_Created TEXT,
            Date_Modified TEXT,
            Product_URL TEXT,
            Footprint_Type TEXT,
            Footprint_Coordinates TEXT,
            LastAccessed INT,
            LastUpdated INT,
            UNIQUE(Product_id))'
        );
        $db->close();
    }

    // Returns the raw stored form of a Product
    public function GetProduct($productid){
        $db = new Sqlite3($this->path);
        $sql = "SELECT * FROM Products WHERE Product_id = :pid";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':pid', $productid);
        $result = $stmt->execute();

        // Fetch the result as an array identified by column names
        $record = $result->fetchArray(SQLITE3_ASSOC);

        // If record is absent, return null
        if($record == false){
            return null;
        }
        // Check age
        $nowTime = date("d-m-Y H:i:s");
        $lastUpdated = strtotime($record["LastUpdated"]);
        // This is in seconds
        $outofdateSeconds = 86400;
        // If entry is old, return null
        if(strtotime($nowTime) - $lastUpdated > $outofdateSeconds){
            // Remove stale entry
            $sql = "DELETE FROM Products WHERE Product_id = :pid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':pid', $productid);
            $result = $stmt->execute();
            // Return null
            return null;
        }

        // Otherwise, update LastAccessed
        $sql = "UPDATE Products SET lastAccessed = :lastAccessed WHERE Product_id = :pid";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':lastAccessed', $nowTime);
        $stmt->bindParam(':pid', $productid);
        $stmt->execute();

        // There should be only 1, so return it
        return $record;
    }

    // Caches a ProductData object to the SQL Database
    public function CacheProduct($product){
        $nowTime = date("d-m-Y H:i:s");
        $db = new Sqlite3($this->path);
        $db->exec("INSERT OR IGNORE INTO Products VALUES('"
        .$product->GetIdentifer()."','"
        .$product->GetName()."','"
        .$product->GetCentre()."','"
        .$product->DateCreated."','"
        .$product->DateModified."','"
        .$product->ProductURL."','"
        .$product->Footprint->Type."','"
        .json_encode($product->Footprint->Coordinates)."','"
        .$nowTime."','"
        .$nowTime."')"
        );
        $db->close();
    }
}
?>
