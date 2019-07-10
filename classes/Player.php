<?php

/**
 * Class Player This class is the main holding area for the player's information.
 */
class Player
{
    private $_name;
    private $_class;
    private $_race;
    private $_armor;
    private $_background;
    private $_weapons;
    private $_shield;
    private $_ac;

    /**
     * Player constructor.
     * @param $_name
     * @param $_class
     * @param $_race
     * @param $_armor
     * @param $_background
     * @param $_weapons
     * @param $shield
     */
    public function __construct($_name, $_class, $_race, $_armor, $_background, $_weapons, $shield)
    {
        $this->_name = $_name;
        $this->_class = $_class;
        $this->_race = $_race;
        $this->armorSelect($_armor);
        $this->_background = $_background;
        $this->_weapons = $_weapons;
        if($shield == 'yes'){
            $this->_shield = 2;
        }
        else{
            $this->_shield = 0;
        }
        $this->calcAC();
    }

    /**
     * @param $_armor
     */
    public function armorSelect($_armor)
    {
        if ($_armor == 'Unarmored') {
            $this->_armor = 0;
        } elseif ($_armor == 'Padded' || $_armor == 'Leather') {
            $this->_armor = 11;
        } elseif ($_armor == 'Studded Leather' || $_armor == 'Hide') {
            $this->_armor = 12;
        } elseif ($_armor == 'Chain shirt') {
            $this->_armor = 13;
        } elseif ($_armor == 'Scale mail' || $_armor == 'Ring mail' || $_armor == 'Breastplate') {
            $this->_armor = 14;
        } elseif ($_armor == 'Half plate') {
            $this->_armor = 15;
        } elseif ($_armor == 'Chain mail') {
            $this->_armor = 16;
        } elseif ($_armor == "Splint") {
            $this->_armor = 17;
        } else {
            $this->_armor = 18;
        }
    }

    public function getShield(){
        return $this->_shield;
    }

    public function setShield($shield){
        $this->_shield = $shield;
    }

    public function getArmor(){
        return $this->_armor;
    }

    public function setArmor($armor){
        $this->_armor = $armor;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->_name = $name;
    }

    /**
     * @return mixed
     */
    public function getClass()
    {
        return $this->_class;
    }

    /**
     * @param mixed $class
     */
    public function setClass($class)
    {
        $this->_class = $class;
    }

    /**
     * @return mixed
     */
    public function getRace()
    {
        return $this->_race;
    }

    /**
     * @param mixed $race
     */
    public function setRace($race)
    {
        $this->_race = $race;
    }

    /**
     * @return mixed
     */
    public function getBackground()
    {
        return $this->_background;
    }

    /**
     * @param mixed $background
     */
    public function setBackground($background)
    {
        $this->_background = $background;
    }

    /**
     * @return mixed
     */
    public function getWeapons()
    {
        return $this->_weapons;
    }

    /**
     * @param mixed $weapons
     */
    public function setWeapons($weapons)
    {
        $this->_weapons = $weapons;
    }

    /**
     * @return mixed
     */
    public function getAc()
    {
        return $this->_ac;
    }

    /**
     * @param mixed $ac
     */
    public function setAc($ac)
    {
        $this->_ac = $ac;
    }

}