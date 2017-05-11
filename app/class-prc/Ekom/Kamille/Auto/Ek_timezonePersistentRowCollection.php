<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_timezonePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_timezone");
        $this->fields = '
ek_timezone.id,
ek_timezone.name
';
        $this->query = '
SELECT
%s
FROM kamille.ek_timezone
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
            ->addControl("name", InputTextControl::create()
                ->label("name")
                ->name("name")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}