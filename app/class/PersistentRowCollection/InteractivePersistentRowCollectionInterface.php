<?php


namespace PersistentRowCollection;


use FormModel\FormModelInterface;

interface InteractivePersistentRowCollectionInterface extends PersistentRowCollectionInterface
{

    /**
     *
     * Return the insert or update form model allowing interaction with the row collection or the row.
     *
     * @param $type , string(insert|update), default=insert
     * @return FormModelInterface, the form model
     */
    public function getForm($type);
}