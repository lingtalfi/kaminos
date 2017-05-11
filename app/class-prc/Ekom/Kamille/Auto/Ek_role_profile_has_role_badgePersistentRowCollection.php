<?php



namespace Prc\Ekom\Kamille\Auto;



use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_role_profile_has_role_badgePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_role_profile_has_role_badge");
        $this->fields = '
ek_role_profile_has_role_badge.role_profile_id,
ek_role_profile_has_role_badge.role_badge_id,
ek_role_profile.label,
ek_role_badge.label
';
        $this->query = '
SELECT
%s
FROM kamille.ek_role_profile_has_role_badge
inner join kamille.ek_role_badge on kamille.ek_role_badge.id=ek_role_profile_has_role_badge.role_badge_id
inner join kamille.ek_role_profile on kamille.ek_role_profile.id=ek_role_profile_has_role_badge.role_profile_id
';
    }


    public function getRic()
    {
        return [
    'role_profile_id',
    'role_badge_id',
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
            ->addControl("role_profile_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_role_profile')
                 
                ->label("role_profile_id")
                ->name("role_profile_id")
            )
            ->addControl("role_badge_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_role_badge')
                 
                ->label("role_badge_id")
                ->name("role_badge_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return null;
    }
}