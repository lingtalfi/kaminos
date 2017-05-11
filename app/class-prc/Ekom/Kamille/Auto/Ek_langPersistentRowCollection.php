<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_langPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_lang");
        $this->fields = '
ek_lang.id,
ek_lang.label,
ek_lang.iso_code
';
        $this->query = '
SELECT
%s
FROM kamille.ek_lang
';
    }


    public function getRic()
    {
        return [
    'id',
];
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function decorateFormModelValidator(ControlsValidator $validator)
    {
        
    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("label", InputTextControl::create()
                ->label("label")
                ->name("label")
            )
            ->addControl("iso_code", InputTextControl::create()
                ->label("iso_code")
                ->name("iso_code")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}