<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;
use Module\NullosAdmin\FormModel\Control\HtmlTextAreaControl;
use Module\NullosAdmin\FormModel\Control\DropZoneControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class ArticlePersistentRowCollection extends QuickPdoPersistentRowCollection
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
            ->addControl("reference_lf", InputTextControl::create()
                ->label("reference_lf")
                ->name("reference_lf")
            )
            ->addControl("reference_hldp", InputTextControl::create()
                ->label("reference_hldp")
                ->name("reference_hldp")
            )
            ->addControl("descr_fr", HtmlTextAreaControl::create()
                ->label("descr_fr")
                ->name("descr_fr")
            )
            ->addControl("descr_en", HtmlTextAreaControl::create()
                ->label("descr_en")
                ->name("descr_en")
            )
            ->addControl("ean", InputTextControl::create()
                ->label("ean")
                ->name("ean")
            )
            ->addControl("photo", DropZoneControl::create()
                ->setShowDeleteLink(true)
                ->setProfileId("AutoAdmin/zilu.article.photo")            
                ->label("photo")
                ->name("photo")
            )
            ->addControl("logo", InputTextControl::create()
                ->label("logo")
                ->name("logo")
            )
            ->addControl("long_desc_en", HtmlTextAreaControl::create()
                ->label("long_desc_en")
                ->name("long_desc_en")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}