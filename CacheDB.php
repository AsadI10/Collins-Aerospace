<?php

class CacheDB{

    private $path;

    function __construct($databasePath){
        $this->path = $databasePath;
        $this->_Init();
    }

    private function _Init(){
        try{
            $db = new Sqlite3($this->path);

            // Create Products table to store ProductData objects
            $db->exec('CREATE TABLE IF NOT EXISTS Products(
                Product_ID TEXT,
                Product_Name TEXT,
                Centre TEXT,
                Document_Type TEXT,
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
        catch(Exception $e){
            RaiseFatalError("Cache DB", $e);
        }
    }

    // Returns the raw stored form of a Product
    public function GetProduct($productid){
        try{
            $db = new Sqlite3($this->path);
            $sql = "SELECT * FROM Products WHERE Product_ID = :pid";
            $stmt = $db->prepare($sql);
            if(!$stmt)
                RaiseFatalError("Cache DB", "Cache Table Missing.");

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
        }
        catch(Exception $e){
            RaiseFatalError("Cache DB", $e);
        }    

        // There should be only 1, so return it
        return $record;
    }

    function debug_to_console($data) {
        $output = $data;
        if (is_array($output))
        $output = implode(',', $output);
        
        echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
        }

    // Caches a ProductData object to the SQL Database
    public function CacheProduct($product){
        //file_put_contents("tmpgeojson.json",'{"type":"Feature","geometry":{"type":"Polygon","coordinates":'.json_encode($product->Footprint->Coordinates).'}}');

        //need to make these reletive
        //shell_exec('bash AntiAliasingScript');

        /*
        for($i = 5; $i <= 10; $i++){
            $fp = simplify_rdp($fp,$tolerance);
            $tolerance / 2;
        }
        */
        //for some reason the compression isnt working atm
        $sssp = simplify_RDP(substr(json_encode($product->Footprint->Coordinates),1,-1), 0.004);



        $nowTime = date("d-m-Y H:i:s");
        $db = new Sqlite3($this->path);
        $db->exec("INSERT OR IGNORE INTO Products VALUES('"
        .$product->GetIdentifer()."','"
        .$product->GetName()."','"
        .$product->GetCentre()."','"
        .$product->DocumentType."','"
        .$product->DateCreated."','"
        .$product->DateModified."','"
        .$product->Footprint->Type."','"
        ."[".$sssp."]','"
        .$product->ProductURL."','"
        .$product->Thumbnail."','"
        .$product->MissionID."','"
        .$product->Creator."','"
        .$nowTime."','"
        .$nowTime."')"
        );
        $db->close();
    }

    public function GetAllStoredMissionIDs(){
        $db = new Sqlite3($this->path);
        $sql = "SELECT DISTINCT Mission_ID FROM Products";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();

        $r = array();
        while ($row = $result->fetchArray(SQLITE3_NUM)) {
            array_push($r,$row);
        }

        return $r;
    }
    public function GetAllStoredDocumentTypes(){
        $db = new Sqlite3($this->path);
        $sql = "SELECT DISTINCT Document_Type FROM Products";
        $stmt = $db->prepare($sql);
        $result = $stmt->execute();

        $r = array();
        while ($row = $result->fetchArray(SQLITE3_NUM)) {
            array_push($r,$row);
        }

        return $r;
    }
}




//optimizing functions (compression etc)
function simplify_RDP($vertices, $tolerance) {
    // if this is a multilinestring, then we call ourselves one each segment individually, collect the list, and return that list of simplified lists
    if (is_array($vertices[0][0])) {
        $multi = array();
        foreach ($vertices as $subvertices) $multi[] = simplify_RDP($subvertices,$tolerance);
        return $multi;
    }

    $tolerance2 = $tolerance * $tolerance;

    // okay, so this is a single linestring and we simplify it individually
    return _segment_RDP($vertices,$tolerance2);
}

function _segment_RDP($segment, $tolerance_squared) {
    if (sizeof($segment) <= 2) return $segment; // segment is too small to simplify, hand it back as-is

    // find the maximum distance (squared) between this line $segment and each vertex
    // distance is solved as described at UCSD page linked above
    // cheat: vertical lines (directly north-south) have no slope so we fudge it with a very tiny nudge to one vertex; can't imagine any units where this will matter
    $startx = (float) $segment[0][0];
    $starty = (float) $segment[0][1];
    $endx   = (float) $segment[ sizeof($segment)-1 ][0];
    $endy   = (float) $segment[ sizeof($segment)-1 ][1];
    if ($endx == $startx) $startx += 0.00001;
    $m = ($endy - $starty) / ($endx - $startx); // slope, as in y = mx + b
    $b = $starty - ($m * $startx);              // y-intercept, as in y = mx + b

    $max_distance_squared = 0;
    $max_distance_index   = null;
    for ($i=1, $l=sizeof($segment); $i<=$l-2; $i++) {
        $x1 = $segment[$i][0];
        $y1 = $segment[$i][1];

        $closestx = ( ($m*$y1) + ($x1) - ($m*$b) ) / ( ($m*$m)+1);
        $closesty = ($m * $closestx) + $b;
        $distsqr  = ($closestx-$x1)*($closestx-$x1) + ($closesty-$y1)*($closesty-$y1);

        if ($distsqr > $max_distance_squared) {
            $max_distance_squared = $distsqr;
            $max_distance_index   = $i;
        }
    }

    // cleanup and disposition
    // if the max distance is below tolerance, we can bail, giving a straight line between the start vertex and end vertex   (all points are so close to the straight line)
    if ($max_distance_squared <= $tolerance_squared) {
        return array($segment[0], $segment[ sizeof($segment)-1 ]);
    }
    // but if we got here then a vertex falls outside the tolerance
    // split the line segment into two smaller segments at that "maximum error vertex" and simplify those
    $slice1 = array_slice($segment, 0, $max_distance_index);
    $slice2 = array_slice($segment, $max_distance_index);
    $segs1 = _segment_RDP($slice1, $tolerance_squared);
    $segs2 = _segment_RDP($slice2, $tolerance_squared);
    return array_merge($segs1,$segs2);
}
?>