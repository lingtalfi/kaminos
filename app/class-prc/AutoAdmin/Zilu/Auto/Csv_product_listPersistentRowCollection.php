<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;
use FormModel\Control\TextAreaControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class Csv_product_listPersistentRowCollection extends QuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.csv_product_list");
        $this->fields = '
csv_product_list.id,
csv_product_list.ref_hldp,
csv_product_list.ref_lf,
csv_product_list.produits
';
        $this->query = '
SELECT
%s
FROM zilu.csv_product_list
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
			->setTests("ref_hldp", "ref_hldp", [
                RequiredControlTest::create(),
            ])
			->setTests("ref_lf", "ref_lf", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("ref_hldp", InputTextControl::create()
                ->label("ref_hldp")
                ->name("ref_hldp")
            )
            ->addControl("ref_lf", InputTextControl::create()
                ->label("ref_lf")
                ->name("ref_lf")
            )
            ->addControl("produits", TextAreaControl::create()
                ->label("produits")
                ->name("produits")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}