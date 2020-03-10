<?php
class Database{
    private $_host = "localhost";
    private $_dbName = "dndchar";
    private $_username = "ryan";
    private $_password = "Sam&Remy123!@#";
    public $conn;

    public function getConnection(){

        $this->conn=null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
    }
}
