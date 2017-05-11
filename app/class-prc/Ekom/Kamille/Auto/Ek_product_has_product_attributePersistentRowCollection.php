<?php



namespace Prc\AutoAdmin\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
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
ek_product.id,
ek_product_attribute.id,
ek_product_attibute_value.id
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
        $validator
			->setTests("product_id", "product_id", [
                RequiredControlTest::create(),
            ])
			->setTests("product_attribute_id", "product_attribute_id", [
                RequiredControlTest::create(),
            ])
			->setTests("product_attibute_value_id", "product_attibute_value_id", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("product_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("product_id")
                ->name("product_id")
            )
            ->addControl("product_attribute_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("product_attribute_id")
                ->name("product_attribute_id")
            )
            ->addControl("product_attibute_value_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("product_attibute_value_id")
                ->name("product_attibute_value_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return null;
    }
}