<?php



namespace Prc\AutoAdmin\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_role_groupPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_role_group");
        $this->fields = '
ek_role_group.id,
ek_role_group.label
';
        $this->query = '
SELECT
%s
FROM kamille.ek_role_group
left join kamille.ek_role_group on kamille.ek_role_group.id=ek_role_group.role_group_id
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
			->setTests("label", "label", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("role_group_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("role_group_id")
                ->name("role_group_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}