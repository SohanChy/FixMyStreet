<?php

class Connection
{
    private $servername = "localhost";
    private $username = "fixmystreetdb_user";
    private $password = "16911691";
    private $dbname = "fixMyStreetdb";
    private $conn;
    public $insert_id;

    public function __construct()
    {
        // Create connection
        $this->conn = new mysqli(
                $this->servername,
                $this->username,
                $this->password,
                $this->dbname
            );

        // Check connection
        if ($this->conn->connect_error) {
            die("Something went wrong :("); //Error Message : $this->conn->connect_error
        }
    }

    public function execute($query)
    {
        $result = $this->conn->query($query);
        if (! $result) {
            die("Something went wrong :(".$this->conn->error); //Error Message : $this->conn->error
        }
        $this->insert_id = $this->conn->insert_id;
        return $result;
    }
}