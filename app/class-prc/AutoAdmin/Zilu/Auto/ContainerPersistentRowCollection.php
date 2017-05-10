<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class ContainerPersistentRowCollection extends QuickPdoPersistentRowCollection
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
        $validator
			->setTests("nom", "nom", [
                RequiredControlTest::create(),
            ])
			->setTests("type_container_id", "type_container_id", [
                RequiredControlTest::create(),
            ]);

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