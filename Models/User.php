<?php

//Model Class for User

class User
{
    public static $tableName = "users";
    public $id, $name, $mobile, $email, $address, $password, $token;
    private $new;

    function __construct($name, $mobile, $email, $address, $password)
    {
        $this->name = $name;
        $this->mobile = $mobile;
        $this->email = $email;
        $this->address = $address;
        $this->password = encPassword($password);
        $this->new = true;
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->new = false;
    }

    //get all Users
    public static function getAll($limit = -1)
    {
        $conn = new Connection();
        $tn = User::$tableName;

        if ($limit == -1) {
            $sql = "SELECT * FROM {$tn}";
        } else {
            $sql = "SELECT * FROM {$tn} LIMIT {$limit}";
        }

        $results = $conn->getConnection()->query($sql);
        $allUsersArray = [];

        if ($results->num_rows > 0) {
            // output data of each row
            while ($row = $results->fetch_assoc()) {
                $userObj = new User(
                        $row['name'],
                        $row['mobile'],
						$row['email'],
                        $row['address'],
                        $row['password']
                    );

                $userObj->setId($row['id']);
                array_push($allUsersArray, $userObj);
            }
            return $allUsersArray;
        } else {
            echo "0 or invalid number of results";
            return $allUsersArray;
        }
    }


    //find and return a User object by id
    public static function find($id)
    {
        $conn = new Connection();
        $tn = User::$tableName;
        $sql = "SELECT * FROM {$tn} where id = {$id}";
        $result = $conn->getConnection()->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $foundUser = new User(
                    $row['name'],
                    $row['mobile'],
                    $row['email'],
                    $row['address'],
                    $row['password'],
                    true
                    );
            $foundUser->setId($row['id']);
            return $foundUser;
        } else {
            echo "0 or invalid number of results";
        }
    }

    public static function findByEmail($email)
    {
        $conn = new Connection();
        $tn = User::$tableName;
        $sql = "SELECT * FROM {$tn} where email = {$email}";
        $result = $conn->getConnection()->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $foundUser = new User(
                    $row['name'],
                    $row['mobile'],
                    $row['email'],
                    $row['address'],
                    $row['password'],
                    true
                    );
            $foundUser->setId($row['id']);
            return $foundUser;
        } else {
            echo "0 or invalid number of results";
        }
    }

    public function save()
    {
        $C = new Connection();
        $conn = $C->getConnection();
        $tn = User::$tableName;

        if ($this->new == true) {
            $sql = "INSERT into {$tn} (name,mobile,email,address,password) values (
                        '{$this->name}',
                        '{$this->mobile}',
                        '{$this->email}',
                        '{$this->address}',
                        '{$this->password}'
                    )";

            if ($conn->query($sql) === true) {
                $this->id = $conn->insert_id;
                $this->new = false;
                return true;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                return false;
            }
        } else {
            $sql = "UPDATE {$tn} set 
                name='{$this->name}',
                mobile='{$this->mobile}',
                email ='{$this->email}'
                address ='{$this->address}' 
                password ='{$this->password}',
                where id={$this->id}";
            $conn->query($sql);
        }
    }

    public function saveToken($token)
    {
        $C = new Connection();
        $conn = $C->getConnection();
        $tn = User::$tableName;
        
        $sql = "UPDATE {$tn} set 
            token='{$token}',
            where id={$this->id}";
        $conn->query($sql);
    }

    public function checkToken($userToken)
    {
        $conn = new Connection();
        $tn = User::$tableName;
        $sql = "SELECT token FROM {$tn} where id = {$this->id}";
        $result = $conn->getConnection()->query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row['token'] == $userToken;
        }
        return false;
    }

    public function delete()
    {
        $C = new Connection();
        $conn = $C->getConnection();
        $tn = User::$tableName;

        if ($this->new != true) {
            $sql = "DELETE FROM {$tn} WHERE id = {$this->id}";
            return $conn->query($sql);
        }
    }

    private function encPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }

    public function verifyPassword($givenPassword)
    {
        return password_verify($this->password, $givenPassword);
    }

    private function generateToken()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $hash = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 20; $i++) {
            $randAlpha = rand(0, $alphaLength);
            $hash[] = $alphabet[$randAlpha];
        }
        return implode($hash);
    }
}
