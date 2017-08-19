<?php

//Model Class for Street

class Street
{
    public static $tableName = "streets";
    public $id, $name, $imageJson, $details, $area_id, $user_id;
    private $new;

    function __construct($name, $imageJson, $details, $area_id, $user_id)
    {
        $this->name = $name;
        $this->imageJson = $imageJson;
        $this->details = $details;
        $this->area_id = $area_id;
        $this->user_id = $user_id;
        $this->new = true;
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->new = false;
    }


    public static function getAll($limit = -1)
    {
        $conn = new Connection();
        $tn = Street::$tableName;

        if ($limit == -1) {
            $sql = "SELECT * FROM {$tn}";
        } else {
            $sql = "SELECT * FROM {$tn} LIMIT {$limit}";
        }

        $results = $conn->getConnection()->query($sql);
        $allStreetArray = [];

        if ($results->num_rows > 0) {
            // output data of each row
            while ($row = $results->fetch_assoc()) {
                $streetObj = new Street(
						$row['name'],
						$row['imageJson'],
						$row['details'],
						$row['area_id'],
						$row['user_id']
                    );

				$streetObj->setId($row['id']);
                array_push($allStreetArray, $streetObj);
            }
            return $allStreetArray;
        } else {
            echo "0 or invalid number of results";
            return $allStreetArray;
        }
    }

    public static function getAllByAreaId($areaId, $limit = -1)
    {
        $conn = new Connection();
        $tn = Street::$tableName;

        if ($limit == -1) {
            $sql = "SELECT * FROM {$tn} where area_id={$areaId}";
        } else {
            $sql = "SELECT * FROM {$tn} where area_id={$areaId} LIMIT {$limit}";
        }

        $results = $conn->getConnection()->query($sql);
        $allStreetArray = [];

        if ($results->num_rows > 0) {
            // output data of each row
            while ($row = $results->fetch_assoc()) {
                $streetObj = new Street(
                    $row['name'],
                    $row['imageJson'],
                    $row['details'],
                    $row['area_id'],
                    $row['user_id']
                    );

                $streetObj->setId($row['id']);
                array_push($allStreetArray, $streetObj);
            }
            return $allStreetArray;
        } else {
            echo "0 or invalid number of results";
            return $allStreetArray;
        }
    }

    public static function searchByName($name, $limit = -1)
    {
        $conn = new Connection();
        $tn = Street::$tableName;

        if ($limit == -1) {
            $sql = "SELECT * FROM {$tn} where name LIKE '%{$name}%'";
        } else {
            $sql = "SELECT * FROM {$tn} where name LIKE '%{$name}%' LIMIT {$limit}";
        }

        $results = $conn->getConnection()->query($sql);
        $allStreetArray = [];

        if ($results->num_rows > 0) {
            // output data of each row
            while ($row = $results->fetch_assoc()) {
                $streetObj = new Street(
                    $row['name'],
                    $row['imageJson'],
                    $row['details'],
                    $row['area_id'],
                    $row['user_id']
                    );

                $streetObj->setId($row['id']);
                array_push($allStreetArray, $streetObj);
            }

            return $allStreetArray;
        } else {
            echo "0 or invalid number of results";
            return $allStreetArray;
        }
    }


    public static function find($id)
    {
        $conn = new Connection();
        $tn = Street::$tableName;
        $sql = "SELECT * FROM {$tn} where id = {$id}";
        $result = $conn->getConnection()->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $foundObj = new Street($row['name'],
                $row['imageJson'],
                $row['details'],
                $row['area_id'],
                $row['user_id']
                );

            $foundObj->setId($row['id']);
            return $foundObj;
        } else {
            echo "0 or invalid number of results";
        }
    }

    public function save()
    {
        $C = new Connection();
        $conn = $C->getConnection();
        $tn = Street::$tableName;

        if ($this->new == true) {
            $sql = "INSERT into {$tn} (name, imageJson, details, area_id, user_id) 
				values ('{$this->name}', '{$this->imageJson}', '{$this->details}', '{$this->area_id}', '{$this->user_id}')";

            if ($conn->query($sql) === true) {
                $this->id = $conn->insert_id;
                $this->new = false;
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                return false;
            }
        } else {
            $sql = "UPDATE {$tn} set name='{$this->name}',
							imageJson='{$this->imageJson}', 
							details='{$this->details}',
							area_id='{$this->area_id}',
							user_id='{$this->user_id}'
							where id={$this->id}";
            return $conn->query($sql);
        }
    }


    public function delete()
    {
        $C = new Connection();
        $conn = $C->getConnection();
        $tn = Street::$tableName;

        if ($this->new != true) {
            $sql = "DELETE FROM {$tn} WHERE id = {$this->id}";
            return $conn->query($sql);
        }
    }
}

// $pro = new Street("a","b","1","d","2","3");
// $pro->save();

// $street = Street::find(5);
// $street->name = "pran water bottle for dogs";
// $street->save();
// cool_dump(); 
