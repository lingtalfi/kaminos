<?php


namespace Module\NullosAdmin\FormModel\Collection;


use FormModel\Collection\FormModelCollectionInterface;

class FormModelCollection implements FormModelCollectionInterface
{


    public static function create()
    {
        return new static();
    }

    public function getFormModel($identifier)
    {
        $ret = false;
        $f = __DIR__ . "/models/$identifier.formmodel.php";
        if (file_exists($f)) {
            $formModel = false;
            include $f;
            $ret = $formModel;
        }
        return $ret;
    }


}