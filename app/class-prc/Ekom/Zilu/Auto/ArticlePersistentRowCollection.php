<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\DropZoneControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class ArticlePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.article");
        $this->fields = '
article.id,
article.reference_lf,
article.reference_hldp,
article.descr_fr,
article.descr_en,
article.ean,
article.photo,
article.logo,
article.long_desc_en
';
        $this->query = '
SELECT
%s
FROM zilu.article
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
			->setTests("reference_lf", "reference_lf", [
                RequiredControlTest::create(),
            ])
			->setTests("reference_hldp", "reference_hldp", [
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
                ->setProfileId("Ekom/zilu.article.photo")            
                ->label("photo")
                ->name("photo")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}