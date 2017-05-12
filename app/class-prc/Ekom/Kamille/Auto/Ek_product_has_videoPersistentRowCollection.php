<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_product_has_videoPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_product_has_video");
        $this->fields = '
ek_product_has_video.product_id,
ek_product_has_video.video_id,
ek_product.product_reference_id,
ek_video.uri
';
        $this->query = '
SELECT
%s
FROM kamille.ek_product_has_video
inner join kamille.ek_product on kamille.ek_product.id=ek_product_has_video.product_id
inner join kamille.ek_video on kamille.ek_video.id=ek_product_has_video.video_id
';
    }


    public function getRic()
    {
        return [
    'product_id',
    'video_id',
];
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function decorateFormModelValidator(ControlsValidator $validator)
    {
        $validator
			->setTests("product_id", "product_id", [
                RequiredControlTest::create(),
            ])
			->setTests("video_id", "video_id", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("product_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, product_reference_id from kamille.ek_product')
                 
                ->label("product_id")
                ->name("product_id")
            )
            ->addControl("video_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, uri from kamille.ek_video')
                 
                ->label("video_id")
                ->name("video_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return null;
    }
}