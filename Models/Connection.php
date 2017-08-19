<?php

class Connection
{

    private $servername = "localhost";
    private $username = "fixmystreetdb_user";
    private $password = "16911691";
    private $dbname = "fixMyStreetdb";

    private $conn;

    public function __construct()
    {
        // Create connection
        $this->conn = new mysqli($this->servername, $this->username,
            $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function close()
    {
        $this->conn->close();
    }
}