<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Control\InputTextControl;
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
        
    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("label", InputTextControl::create()
                ->label("label")
                ->name("label")
            )
            ->addControl("role_group_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_role_group')
                ->firstOption("Please choose an option", 0) 
                ->label("role_group_id")
                ->name("role_group_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}