<?php

class Character
{

    private $conn;
    private $table_name = "characters";

    public $_name;
    public $_race;
    public $_class;
    public $_str;
    public $_dex;
    public $_con;
    public $_wis;
    public $_int;
    public $_cha;
    public $_initiative;

    public function __construct($db)
    {
        $this->conn=$db;
    }

    function create(){
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, race=:race, class=:class, str=:str, dex=:dex, con=:con,
                wis=:wis, int=:int, cha=:cha";

        $stmt=$this->conn->prepare($query);

        $this->_name=htmlspecialchars(strip_tags($this->_name));
        $this->_race=htmlspecialchars(strip_tags($this->_race));
        $this->_class=htmlspecialchars(strip_tags($this->_class));
        $this->_str=htmlspecialchars(strip_tags($this->_str));
        $this->_dex=htmlspecialchars(strip_tags($this->_dex));
        $this->_con=htmlspecialchars(strip_tags($this->_con));
        $this->_wis=htmlspecialchars(strip_tags($this->_wis));
        $this->_int=htmlspecialchars(strip_tags($this->_int));
        $this->_cha=htmlspecialchars(strip_tags($this->_cha));

        $stmt->bindParam(":name",$this->_name);
        $stmt->bindParam(":race",$this->_race);
        $stmt->bindParam(":class",$this->_class);
        $stmt->bindParam(":str",$this->_str);
        $stmt->bindParam(":dex",$this->_dex);
        $stmt->bindParam(":con",$this->_con);
        $stmt->bindParam(":wis",$this->_wis);
        $stmt->bindParam(":int",$this->_int);
        $stmt->bindParam(":cha",$this->_cha);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function readOne(){
        $query = "SELECT
            name, race, class, str, dex, con, wis, int, cha, initiative
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
        $this->_str = $row['str'];
        $this->_dex = $row['dex'];
        $this->_con = $row['con'];
        $this->_wis = $row['wis'];
        $this->_int = $row['int'];
        $this->_cha = $row['cha'];
        $this->_initiative = $row['initiative'];
    }

    function update(){
        $query = "UPDATE
                        ". $this->table_name . "
                    SET
                        race = :race,
                        class = :class,
                        str = :str,
                        dex = :dex,
                        con = :con,
                        wis = :wis,
                        int = :int,
                        cha = :cha,
                        initiative = :initiative
                    WHERE
                        name = :name";

        $stmt = $this->conn->prepare($query);

        $this->_name = htmlspecialchars(strip_tags($this->_name));
        $this->_race = htmlspecialchars(strip_tags($this->_race));
        $this->_class = htmlspecialchars(strip_tags($this->_class));
        $this->_str = htmlspecialchars(strip_tags($this->_str));
        $this->_dex = htmlspecialchars(strip_tags($this->_dex));
        $this->_con = htmlspecialchars(strip_tags($this->_con));
        $this->_wis = htmlspecialchars(strip_tags($this->_wis));
        $this->_int = htmlspecialchars(strip_tags($this->_int));
        $this->_cha = htmlspecialchars(strip_tags($this->_cha));
        $this->_initiative = htmlspecialchars(strip_tags($this->_initiative));

        $stmt->bindParam(':name', $this->_name);
        $stmt->bindParam(':race', $this->_race);
        $stmt->bindParam(':class', $this->_class);
        $stmt->bindParam(':str', $this->_str);
        $stmt->bindParam(':dex', $this->_dex);
        $stmt->bindParam(':con', $this->_con);
        $stmt->bindParam(':wis', $this->_wis);
        $stmt->bindParam(':int', $this->_int);
        $stmt->bindParam(':cha', $this->_cha);
        $stmt->bindParam(':initiative', $this->_initiative);

        if($stmt->exwcute()){
            return true;
        }
        return false;
    }

    function delete(){
        $query = "DELETE FROM " . $this->$this->table_name . " WHERE name = ?";

        $stmt = $this->conn->prepare($query);

        $this->_name = htmlspecialchars(strip_tags($this->_name));

        $stmt->bindParam(1, $this->_name);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function search($keywords){
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
}