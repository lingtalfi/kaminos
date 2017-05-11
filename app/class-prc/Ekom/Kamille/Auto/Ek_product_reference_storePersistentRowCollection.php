<?php



namespace Prc\Ekom\Kamille\Auto;



use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;
use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_product_reference_storePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_product_reference_store");
        $this->fields = '
ek_product_reference_store.id,
ek_store.label,
ek_product_reference_store.quantity,
ek_product_reference.natural_reference
';
        $this->query = '
SELECT
%s
FROM kamille.ek_product_reference_store
inner join kamille.ek_product_reference on kamille.ek_product_reference.id=ek_product_reference_store.product_reference_id
inner join kamille.ek_store on kamille.ek_store.id=ek_product_reference_store.store_id
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
            ->addControl("store_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_store')
                 
                ->label("store_id")
                ->name("store_id")
            )
            ->addControl("quantity", InputTextControl::create()
                ->label("quantity")
                ->name("quantity")
            )
            ->addControl("product_reference_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, natural_reference from kamille.ek_product_reference')
                 
                ->label("product_reference_id")
                ->name("product_reference_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}