<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;
use FormModel\Control\TextAreaControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class Csv_product_detailsPersistentRowCollection extends QuickPdoPersistentRowCollection
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
            ->addControl("ref", InputTextControl::create()
                ->label("ref")
                ->name("ref")
            )
            ->addControl("product_fr", InputTextControl::create()
                ->label("product_fr")
                ->name("product_fr")
            )
            ->addControl("product", InputTextControl::create()
                ->label("product")
                ->name("product")
            )
            ->addControl("photo", InputTextControl::create()
                ->label("photo")
                ->name("photo")
            )
            ->addControl("features", TextAreaControl::create()
                ->label("features")
                ->name("features")
            )
            ->addControl("logo", InputTextControl::create()
                ->label("logo")
                ->name("logo")
            )
            ->addControl("packing", TextAreaControl::create()
                ->label("packing")
                ->name("packing")
            )
            ->addControl("ean", InputTextControl::create()
                ->label("ean")
                ->name("ean")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}