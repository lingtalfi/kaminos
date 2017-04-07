<?php


namespace FormModel\Group;

use FormModel\Control\ControlInterface;

interface GroupInterface
{

    //--------------------------------------------
    // CONTROLS/GROUPS
    //--------------------------------------------
    public function addControl($id, ControlInterface $controller);

    public function addGroup($id, GroupInterface $group);


    //--------------------------------------------
    // ATTRIBUTE
    //--------------------------------------------
    public function setLabel($label);
}