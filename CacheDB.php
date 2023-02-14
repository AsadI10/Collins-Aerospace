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
            Product_ID TEXT,
            Product_Name TEXt,
            Centre TEXT,
            Date_Created TEXT,
            Date_Modified TEXT,
            Footprint_Type TEXT,
            Footprint_Coordinates TEXT,
            Product_URL TEXT,
            Thumbnail_URL TEXT,
            Mission_ID TEXT,
            Creator TEXT,
            Last_Accessed INT,
            Last_Updated INT,
            UNIQUE(Product_id))'
        );
        $db->close();
    }

    // Returns the raw stored form of a Product
    public function GetProduct($productid){
        $db = new Sqlite3($this->path);
        $sql = "SELECT * FROM Products WHERE Product_ID = :pid";
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
        $lastUpdated = strtotime($record["Last_Updated"]);
        // This is in seconds
        $outofdateSeconds = 86400;
        // If entry is old, return null
        if(strtotime($nowTime) - $lastUpdated > $outofdateSeconds){
            // Remove stale entry
            $sql = "DELETE FROM Products WHERE Product_ID = :pid";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':pid', $productid);
            $result = $stmt->execute();
            // Return null
            return null;
        }

        // Otherwise, update LastAccessed
        $sql = "UPDATE Products SET Last_Accessed = :lastAccessed WHERE Product_ID = :pid";
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
        .$product->Footprint->Type."','"
        .json_encode($product->Footprint->Coordinates)."','"
        .$product->ProductURL."','"
        .$product->Thumbnail."','"
        .$product->MissionID."','"
        .$product->Creator."','"
        .$nowTime."','"
        .$nowTime."')"
        );
        $db->close();
    }
}
?>
