<?php

class User
{
    public static $tableName = "users";
    public $id, $name, $mobile, $email, $address, $password;
    private $new;

    function __construct($name, $mobile, $email, $address, $password)
    {
        $this->name = $name;
        $this->mobile = $mobile;
        $this->email = $email;
        $this->address = $address;
        $this->password = $password;
        $this->new = true;
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->new = false;
    }

    public static function find($id)
    {
        $conn = new Connection();
        $tn = self::$tableName;

        $query = "SELECT * FROM {$tn} WHERE id = {$id}";
        $result = $conn->execute($query);

        return self::checkResult($result);
    }

    public static function findByEmailOrMobile($data)
    {
        $conn = new Connection();
        $tn = self::$tableName;
        
        $dataType = filter_var($data, FILTER_VALIDATE_EMAIL) ? "email" : "mobile";
        $query = "SELECT * FROM {$tn} WHERE {$dataType}={$email}";
        $result = $conn->execute($query);

        return self::checkResult($result);
    }

    public static function findByToken($token)
    {
        $conn = new Connection();
        $tn = self::$tableName;
        
        $query = "SELECT * FROM {$tn} WHERE token={$token}";
        $result = $conn->execute($query);

        return self::checkResult($result);
    }

    public function save()
    {
        $conn = new Connection();
        $tn = self::$tableName;

        if ($this->new) {
            $query = "INSERT INTO {$tn} (name, mobile, email, address, password) VALUES (
                        '{$this->name}',
                        '{$this->mobile}',
                        '{$this->email}',
                        '{$this->address}',
                        '{$this->encPassword(password)}'
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
                mobile='{$this->mobile}',
                email='{$this->email}',
                address='{$this->address}',
                password='{$this->encPassword(password)}'
                WHERE id={$this->id}";
            $result = $conn->execute($query);
            
            if ($result->num_rows == 1)
                return true;
            return false;
        }
        return false;
    }

    public function rememberToken($null = false)
    {
        $conn = new Connection();
        $tn = self::$tableName;

        $token = $null ? "" : $this->generateToken();
        $query = "UPDATE {$tn} SET token='{$token}' WHERE id={$this->id}";
        $result = $conn->execute($query);

        if ($result->num_rows == 1)
            return true;
        return false;
    }

    public function checkToken($userToken)
    {
        $conn = new Connection();
        $tn = self::$tableName;

        $query = "SELECT token FROM {$tn} WHERE id={$this->id}";
        $result = $conn->execute($query);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row['token'] == $userToken;
        }
        return false;
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
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $obj = new User(
                    $row['name'],
                    $row['mobile'],
                    $row['email'],
                    $row['address'],
                    $row['password']
                );
            $obj->setId($row['id']);
            return $obj;
        } else {
            return false;
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
