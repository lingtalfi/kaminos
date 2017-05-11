<?php



namespace Prc\Ekom\Kamille\Auto;



use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_product_has_product_attributePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_product_has_product_attribute");
        $this->fields = '
ek_product_has_product_attribute.product_id,
ek_product_has_product_attribute.product_attribute_id,
ek_product.product_reference_id,
ek_product_attribute.label,
ek_product_attibute_value.label
';
        $this->query = '
SELECT
%s
FROM kamille.ek_product_has_product_attribute
inner join kamille.ek_product on kamille.ek_product.id=ek_product_has_product_attribute.product_id
inner join kamille.ek_product_attibute_value on kamille.ek_product_attibute_value.id=ek_product_has_product_attribute.product_attibute_value_id
inner join kamille.ek_product_attribute on kamille.ek_product_attribute.id=ek_product_has_product_attribute.product_attribute_id
';
    }


    public function getRic()
    {
        return [
    'product_id',
    'product_attribute_id',
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
            ->addControl("product_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, product_reference_id from kamille.ek_product')
                 
                ->label("product_id")
                ->name("product_id")
            )
            ->addControl("product_attribute_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_product_attribute')
                 
                ->label("product_attribute_id")
                ->name("product_attribute_id")
            )
            ->addControl("product_attibute_value_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_product_attibute_value')
                 
                ->label("product_attibute_value_id")
                ->name("product_attibute_value_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return null;
    }
}