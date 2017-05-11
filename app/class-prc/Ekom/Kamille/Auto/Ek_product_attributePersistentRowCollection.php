<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Control\InputTextControl;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_product_attributePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_product_attribute");
        $this->fields = '
ek_product_attribute.id,
ek_product_attribute.label,
ek_lang.label
';
        $this->query = '
SELECT
%s
FROM kamille.ek_product_attribute
inner join kamille.ek_lang on kamille.ek_lang.id=ek_product_attribute.lang_id
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
            ->addControl("lang_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_lang')
                 
                ->label("lang_id")
                ->name("lang_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}