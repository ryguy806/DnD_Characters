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
}