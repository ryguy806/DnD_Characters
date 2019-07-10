<?php


class Human_Warlock extends Player
{
    private $_ac;
    private $_dex;
    private $_str;
    private $_con;
    private $_wis;
    private $_int;
    private $_cha;
    function __construct($_name, $_class, $_race, $_armor, $_background, $_weapons, $shield)
    {
        parent::__construct($_name, $_class, $_race, $_armor, $_background, $_weapons, $shield);
    }

    public function calcAC(){
        $this->_ac = parent::getShield() + parent::getArmor() + $this->_dex;
    }


}