<?php



namespace Module\NullosAdmin\PersistentRowCollection;


use FormModel\FormModelInterface;
use Module\NullosAdmin\FormModel\NullosFormModel;
use PersistentRowCollection\QuickPdoPersistentRowCollection;

abstract class NullosQuickPdoPersistentRowCollection extends QuickPdoPersistentRowCollection{
    /**
     * @return FormModelInterface
     */
    protected function getFormModelInstance()
    {
        return NullosFormModel::create();
    }
}


