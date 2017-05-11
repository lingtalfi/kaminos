<?php



namespace Prc\Ekom\Kamille\Auto;



use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;
use Module\NullosAdmin\FormModel\Control\InputSwitchControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_shop_has_productPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_shop_has_product");
        $this->fields = '
ek_shop_has_product.shop_id,
ek_shop_has_product.product_id,
ek_shop.label,
ek_product.product_reference_id,
ek_shop_has_product.active
';
        $this->query = '
SELECT
%s
FROM kamille.ek_shop_has_product
inner join kamille.ek_product on kamille.ek_product.id=ek_shop_has_product.product_id
inner join kamille.ek_shop on kamille.ek_shop.id=ek_shop_has_product.shop_id
';
    }


    public function getRic()
    {
        return [
    'shop_id',
    'product_id',
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
            ->addControl("shop_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_shop')
                 
                ->label("shop_id")
                ->name("shop_id")
            )
            ->addControl("product_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, product_reference_id from kamille.ek_product')
                 
                ->label("product_id")
                ->name("product_id")
            )
            ->addControl("active", InputSwitchControl::create()
                ->label("active")
                ->name("active")
                ->addHtmlAttribute("value", "1")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return null;
    }
}