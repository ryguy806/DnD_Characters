<?php

/**
 * Class Player This class is the main holding area for the player's information.
 *
 * Ryan Guelzo
 * version 1
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
    private $_str;
    private $_con;
    private $_wis;
    private $_int;
    private $_cha;

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
        $this->setStats();
        $this->_ac = $this->calcAC();

    }

    private function calcAC(){
        return $this->_shield + $this->_dex + $this->_armor;
    }

    /**
     * @param $_armor
     */
    private function armorSelect($_armor)
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

    private function setStats(){
        $this->_str = $this->statRoller();
        $this->_dex = $this->statRoller();
        $this->_con = $this->statRoller();
        $this->_wis = $this->statRoller();
        $this->_int = $this->statRoller();
        $this->_cha = $this->statRoller();
    }

    private function statRoller(){
        $nums = array(mt_rand(1, 6), mt_rand(1, 6), mt_rand(1, 6), mt_rand(1, 6));

        $total = $nums[1] + $nums[2] + $nums[3] + $nums[4];

        $total = $total - min($nums);

        return $total;
    }

}