<?php

//Model Class for Area

class Area
{
    public static $tableName = "areas";
    public $id, $name, $user_id;
    private $new;

    function __construct($name, $user_id)
    {
        $this->name = $name;
        $this->user_id =$user_id;
        $this->new = true;
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->new = false;
    }

    //get all Areas
    public static function getAll($limit = -1)
    {
        $conn = new Connection();
        $tn = Area::$tableName;

        $sql = $limit == -1 ? "SELECT * FROM {$tn}" : "SELECT * FROM {$tn} LIMIT {$limit}";

        $results = $conn->getConnection()->query($sql);
        $allAreaArray = [];

        if ($results->num_rows > 0) {
            // output data of each row
            while ($row = $results->fetch_assoc()) {
                $areaObj = new Area(
                    	$row['name'],
                        $row['user_id']
                    );
                $areaObj->setId($row['id']);
                array_push($allAreaArray, $areaObj);
            }
            return $allAreaArray;
        } else {
            echo "0 or invalid number of results";
            return $allAreaArray;
        }
    }


    //find and return an Area object by id
    public static function find($id)
    {
        $conn = new Connection();
        $tn = Area::$tableName;
        $sql = "SELECT * FROM {$tn} where id = {$id}";
        $result = $conn->getConnection()->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $foundArea = new Area($row['name'], $row['user_id']);
            $foundArea->setId($row['id']);
            return $foundArea;
        } else {
            echo "0 or invalid number of results";
        }
    }
    
    //find and return an Area object by name
    public static function searchByName($name, $limit = -1)
    {
        $conn = new Connection();
        $tn = Area::$tableName;

        if ($limit == -1) {
            $sql = "SELECT * FROM {$tn} where name = '{$name}'";
        } else {
            $sql = "SELECT * FROM {$tn} where name = '{$name}' LIMIT {$limit}";
        }

        $results = $conn->getConnection()->query($sql);

        if ($results->num_rows == 1) {
            $row = $results->fetch_assoc();
                $areaObj = new Area(
                    $row['name'],
                    $row['user_id']
                    );

                $areaObj->setId($row['id']);
            return $areaObj;
        } else {
            return false;
        }
    }

    public function save()
    {
        $C = new Connection();
        $conn = $C->getConnection();
        $tn = Area::$tableName;

        if ($this->new == true) {
            $sql = "INSERT into {$tn} (name, user_id) values ('{$this->name}','{$this->user_id}')";

            if ($conn->query($sql) === true) {
                $this->id = $conn->insert_id;
                $this->new = false;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            $sql = "UPDATE {$tn} set name = '{$this->name}', user_id = '{$this->user_id}' where id = {$this->id}";
            return $conn->query($sql);
        }
    }

    public function delete()
    {
        $C = new Connection();
        $conn = $C->getConnection();
        $tn = Area::$tableName;

        if ($this->new != true) {
            $sql = "DELETE FROM {$tn} WHERE id = {$this->id}";
            return $conn->query($sql);
        }
    }
}

// var_dump(Area::getAll());
// echo "<hr>";
// cool_dump(Area::getAll());
//
// $obj = new Area("uttara");
// var_dump($obj);echo "<hr>";
//
//
// $obj->save();
// var_dump($obj);echo "<hr>";
//
//
// $obj->name = "badda";
// $obj->save();
// var_dump($obj);echo "<hr>";
//
//
//$obj->delete();
