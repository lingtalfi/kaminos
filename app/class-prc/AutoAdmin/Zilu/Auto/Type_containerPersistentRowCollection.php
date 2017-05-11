<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Type_containerPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.type_container");
        $this->fields = '
type_container.id,
type_container.label,
type_container.poids_max,
type_container.volume_max
';
        $this->query = '
SELECT
%s
FROM zilu.type_container
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
            ->addControl("label", InputTextControl::create()
                ->label("label")
                ->name("label")
            )
            ->addControl("poids_max", InputTextControl::create()
                ->label("poids_max")
                ->name("poids_max")
            )
            ->addControl("volume_max", InputTextControl::create()
                ->label("volume_max")
                ->name("volume_max")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}