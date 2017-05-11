<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Control\InputTextControl;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class ContainerPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.container");
        $this->fields = '
container.id,
container.nom,
type_container.label
';
        $this->query = '
SELECT
%s
FROM zilu.container
inner join zilu.type_container on zilu.type_container.id=container.type_container_id
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
            ->addControl("nom", InputTextControl::create()
                ->label("nom")
                ->name("nom")
            )
            ->addControl("type_container_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from zilu.type_container')
                 
                ->label("type_container_id")
                ->name("type_container_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}