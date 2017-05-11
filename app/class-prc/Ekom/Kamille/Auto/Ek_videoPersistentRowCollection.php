<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_videoPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_video");
        $this->fields = '
ek_video.id,
ek_video.uri
';
        $this->query = '
SELECT
%s
FROM kamille.ek_video
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
            ->addControl("uri", InputTextControl::create()
                ->label("uri")
                ->name("uri")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}