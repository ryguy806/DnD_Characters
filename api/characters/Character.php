<?php

class Character
{

    private $conn;
    private $table_name = "characters";

    public $_name;
    public $_race;
    public $_class;
    public $_initiative = 0;

    public function __construct($db)
    {
        $this->conn=$db;
    }

    public function setInitiative($initiative){
        $this->_initiative = $initiative;
    }

    public function create(){
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                'name'=':name', 'race'=':race', 'class'=':class', 'initiative'=':initiative'";

        $stmt=$this->conn->prepare($query);

        $this->_name=htmlspecialchars(strip_tags($this->_name));
        $this->_race=htmlspecialchars(strip_tags($this->_race));
        $this->_class=htmlspecialchars(strip_tags($this->_class));

        $stmt->bindParam(":name",$this->_name);
        $stmt->bindParam(":race",$this->_race);
        $stmt->bindParam(":class",$this->_class);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function readOne(){
        $query = "SELECT
            name, race, class, initiative
            LIMIT
            0,1;
        ";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, 'name');

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->_name = $row['name'];
        $this->_race = $row['race'];
        $this->_class = $row['class'];
        $this->_initiative = $row['initiative'];
    }

    public function update(){
        $query = "UPDATE
                        ". $this->table_name . "
                    SET
                        race = :race,
                        class = :class,
                        initiative = :initiative
                    WHERE
                        name = :name";

        $stmt = $this->conn->prepare($query);

        $this->_name = htmlspecialchars(strip_tags($this->_name));
        $this->_race = htmlspecialchars(strip_tags($this->_race));
        $this->_class = htmlspecialchars(strip_tags($this->_class));
        $this->_initiative = htmlspecialchars(strip_tags($this->_initiative));

        $stmt->bindParam(':name', $this->_name);
        $stmt->bindParam(':race', $this->_race);
        $stmt->bindParam(':class', $this->_class);
        $stmt->bindParam(':initiative', $this->_initiative);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function delete(){
        $query = "DELETE FROM " . $this->$this->table_name . " WHERE name = ?";

        $stmt = $this->conn->prepare($query);

        $this->_name = htmlspecialchars(strip_tags($this->_name));

        $stmt->bindParam(1, $this->_name);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function search($keywords){
        $query = "SELECT
                    'name', 'race', 'class', 'str', 'dex', 'con', 'wis', 'int', 'cha', 'initiative'
                  FROM
                    " . $this->table_name . "
                  WHERE
                    'name' LIKE ? OR 'race' LIKE ? OR 'class' LIKE ?
                  ORDER BY 
                    'initiative' DESC";
        $stmt = $this->conn->prepare();

        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{keywords}";

        $stmt->bindParam(1, $keywords);
        $stmt->bindParam(2, $keywords);
        $stmt->bindParam(3, $keywords);

        $stmt->execute();

        return $stmt;
    }

    public function readPaging($from_record_num, $records_per_page){
        $query = "SELECT FROM " . $this->table_name . " ORDER BY 'initiative' DESC LIMIT ?, ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt;
    }

    public function count(){
        $query = "SELECT COUNT(*) as total_rows FROM" . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }


}