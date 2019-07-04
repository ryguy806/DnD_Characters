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
    private $_dex;

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
    }

    public function calcAC(){
        $this->_ac = $this->_shield + $this->_armor + $this->_dex;
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


}