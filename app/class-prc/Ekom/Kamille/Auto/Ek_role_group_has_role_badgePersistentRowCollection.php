<?php



namespace Prc\AutoAdmin\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_role_group_has_role_badgePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_role_group_has_role_badge");
        $this->fields = '
ek_role_group_has_role_badge.role_group_id,
ek_role_group_has_role_badge.role_badge_id,
ek_role_group.id,
ek_role_badge.id
';
        $this->query = '
SELECT
%s
FROM kamille.ek_role_group_has_role_badge
inner join kamille.ek_role_badge on kamille.ek_role_badge.id=ek_role_group_has_role_badge.role_badge_id
inner join kamille.ek_role_group on kamille.ek_role_group.id=ek_role_group_has_role_badge.role_group_id
';
    }


    public function getRic()
    {
        return [
    'role_group_id',
    'role_badge_id',
];
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function decorateFormModelValidator(ControlsValidator $validator)
    {
        $validator
			->setTests("role_group_id", "role_group_id", [
                RequiredControlTest::create(),
            ])
			->setTests("role_badge_id", "role_badge_id", [
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
            )
            ->addControl("role_badge_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("role_badge_id")
                ->name("role_badge_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return null;
    }
}