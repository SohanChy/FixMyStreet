<?php

class Area
{
    public static $tableName = "areas";
    public $id, $name, $user_id;
    private $new;

    function __construct($name, $user_id)
    {
        $this->name = $name;
        $this->user_id = $user_id;
        $this->new = true;
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->new = false;
    }

    public static function getAll()
    {
        $conn = new Connection();
        $tn = self::$tableName;

        $query = "SELECT * FROM {$tn}";
        $result = $conn->execute($query);
        
        return self::checkResult($result);
    }

    public static function find($id)
    {
        $conn = new Connection();
        $tn = self::$tableName;
        
        $query = "SELECT * FROM {$tn} WHERE id={$id}";
        $result = $conn->execute($query);

        return self::checkResult($result)[0]; // Assume that checkResult() will not return false
    }
    
    public function save()
    {
        $conn = new Connection();
        $tn = self::$tableName;

        if ($this->new == true) {
            $query = "INSERT INTO {$tn} (name, user_id) VALUES (
                    '{$this->name}',
                    '{$this->user_id}'
                )";
            $result = $conn->execute($query);

            if ($result === true) {
                $this->setId($conn->insert_id);
                return true;
            } else {
                return false;
            }
        } else {
            $query = "UPDATE {$tn} SET
                name='{$this->name}',
                user_id='{$this->user_id}'
                WHERE id={$this->id}";
            $result = $conn->execute($query);
            
            if ($result->num_rows == 1)
                return true;
            return false;
        }
    }
    
    public function delete()
    {
        $conn = new Connection();
        $tn = self::$tableName;

        if (! $this->new) {
            $query = "DELETE FROM {$tn} WHERE id={$this->id}";
            $result = $conn->execute($query);

            if ($result->num_rows == 1)
                return true;
            return false;
        }
        return false;
    }

    private static function checkResult($result)
    {
        $array = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $obj = new Area(
                    	$row['name'],
                        $row['user_id']
                    );
                $obj->setId($row['id']);
                array_push($array, $obj);
            }
            return $array;
        } else {
            return false;
        }
    }
}
