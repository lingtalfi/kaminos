<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\DropZoneControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Csv_product_detailsPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.csv_product_details");
        $this->fields = '
csv_product_details.id,
csv_product_details.ref,
csv_product_details.product_fr,
csv_product_details.product,
csv_product_details.photo,
csv_product_details.features,
csv_product_details.logo,
csv_product_details.packing,
csv_product_details.ean
';
        $this->query = '
SELECT
%s
FROM zilu.csv_product_details
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
			->setTests("ref", "ref", [
                RequiredControlTest::create(),
            ])
			->setTests("product_fr", "product_fr", [
                RequiredControlTest::create(),
            ])
			->setTests("product", "product", [
                RequiredControlTest::create(),
            ])
			->setTests("photo", "photo", [
                RequiredControlTest::create(),
            ])
			->setTests("logo", "logo", [
                RequiredControlTest::create(),
            ])
			->setTests("ean", "ean", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("photo", DropZoneControl::create()
                ->setShowDeleteLink(true)
                ->setProfileId("Ekom/zilu.csv_product_details.photo")            
                ->label("photo")
                ->name("photo")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}