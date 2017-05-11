<?php



namespace Prc\AutoAdmin\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\DropZoneControl;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_product_reference_shopPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_product_reference_shop");
        $this->fields = '
ek_product_reference_shop.id,
ek_product_reference_shop.image,
ek_product_reference_shop.prix_ht,
ek_shop.id,
ek_product_reference.id
';
        $this->query = '
SELECT
%s
FROM kamille.ek_product_reference_shop
inner join kamille.ek_product_reference on kamille.ek_product_reference.id=ek_product_reference_shop.product_reference_id
inner join kamille.ek_shop on kamille.ek_shop.id=ek_product_reference_shop.shop_id
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
        $validator
			->setTests("image", "image", [
                RequiredControlTest::create(),
            ])
			->setTests("shop_id", "shop_id", [
                RequiredControlTest::create(),
            ])
			->setTests("product_reference_id", "product_reference_id", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("image", DropZoneControl::create()
                ->setShowDeleteLink(true)
                ->setProfileId("Ekom/kamille.ek_product_reference_shop.image")            
                ->label("image")
                ->name("image")
            )
            ->addControl("shop_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("shop_id")
                ->name("shop_id")
            )
            ->addControl("product_reference_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("product_reference_id")
                ->name("product_reference_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}