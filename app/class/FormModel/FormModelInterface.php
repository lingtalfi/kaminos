<?php


namespace FormModel;


use FormModel\Group\GroupInterface;
use Kamille\Architecture\Controller\ControllerInterface;

interface FormModelInterface
{


    //--------------------------------------------
    // FORM
    //--------------------------------------------
    public function setAction($action);

    public function setMethod($method);

    public function addFormAttribute($key, $value);

    public function addMessage($msg, $type);

    public function setFormErrorPosition($formErrorPosition);

    public function setDisplayFirstErrorOnly($bool);

    //--------------------------------------------
    // CONTROLS/GROUPS
    //--------------------------------------------
    public function addControl($id, ControllerInterface $controller);

    public function addGroup($id, GroupInterface $group);


    //--------------------------------------------
    // ORDER
    //--------------------------------------------
    public function setOrder(array $order);


}