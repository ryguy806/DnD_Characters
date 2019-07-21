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
    public function __construct($_name = null, $_class = null, $_race = null, $_armor = null, $_background = null,
                                $_weapons = null, $shield = null)
    {
        if($_name == null){
            $this->randomCharacter();
        }
        else{
            $this->_name = $_name;
            $this->_class = $_class;
            $this->_race = $_race;
            $this-> _armor = $this->armorSelect($_armor);
            $this->_background = $_background;
            $this->_weapons = $_weapons;
            if($shield == 'yes'){
                $this->_shield = 2;
            }
            else{
                $this->_shield = 0;
            }
        }
        $this->setStats();
        $this->_ac = $this->calcAC();
    }

    private function calcAC(){
        return $this->_shield + $this->_dex + $this->_armor;
    }

    /**
     * @param $_armor
     * @return int the value the armor adds.
     */
    private function armorSelect($_armor)
    {
        if ($_armor == 'Unarmored') {
            return 0;
        } elseif ($_armor == 'Padded' || $_armor == 'Leather') {
            return 11;
        } elseif ($_armor == 'Studded Leather' || $_armor == 'Hide') {
            return 12;
        } elseif ($_armor == 'Chain shirt') {
            return 13;
        } elseif ($_armor == 'Scale mail' || $_armor == 'Ring mail' || $_armor == 'Breastplate') {
            return 14;
        } elseif ($_armor == 'Half plate') {
            return 15;
        } elseif ($_armor == 'Chain mail') {
            return 16;
        } elseif ($_armor == "Splint") {
            return 17;
        } else {
            return 18;
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

    public function randomCharacter(){
        $backgrounds = array("Acolyte", "Charlatan", "Criminal", "Entertainer", "Folk Hero", "Guild Artisan", "Hermit",
            "Noble", "Outlander", "Sage", "Sailor", "Soldier", "Urchin");
        $classes = array("Barbarian", "Bard", "Cleric", "Druid", "Fighter", "Monk", "Paladin", "Ranger", "Rogue",
            "Sorcerer", "Warlock", "Wizard");
        $races = array("Dragonborn", "Dwarf", "Elf", "Gnome", "Halfling", "Half-Elf", "Half-Orc", "Human", "Tiefling");
        $weapons = array();
        $shield = array(true, false);
        $armor = array();
        $this->_class = $classes[mt_rand(0, 11)];
        $this->_background = $backgrounds[mt_rand(0, 12)];
        $this->_race = $races[mt_rand(0, 8)];
    }

}