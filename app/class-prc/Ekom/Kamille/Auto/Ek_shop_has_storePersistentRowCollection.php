<?php



namespace Prc\Ekom\Kamille\Auto;



use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_shop_has_storePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_shop_has_store");
        $this->fields = '
ek_shop_has_store.shop_id,
ek_shop_has_store.store_id,
ek_shop.label,
ek_store.label
';
        $this->query = '
SELECT
%s
FROM kamille.ek_shop_has_store
inner join kamille.ek_shop on kamille.ek_shop.id=ek_shop_has_store.shop_id
inner join kamille.ek_store on kamille.ek_store.id=ek_shop_has_store.store_id
';
    }


    public function getRic()
    {
        return [
    'shop_id',
    'store_id',
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
            ->addControl("store_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_store')
                 
                ->label("store_id")
                ->name("store_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return null;
    }
}