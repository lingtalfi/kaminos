<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Control\InputTextControl;
use Module\NullosAdmin\FormModel\Control\DropZoneControl;
use FormModel\Control\TextAreaControl;

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
            ->addControl("photo", DropZoneControl::create()
                ->setShowDeleteLink(true)
                ->setProfileId("AutoAdmin/zilu.csv_product_details.photo")            
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