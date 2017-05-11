<?php



namespace Prc\AutoAdmin\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_role_profilePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_role_profile");
        $this->fields = '
ek_role_profile.id,
ek_role_profile.label,
ek_backoffice_user.id
';
        $this->query = '
SELECT
%s
FROM kamille.ek_role_profile
inner join kamille.ek_backoffice_user on kamille.ek_backoffice_user.id=ek_role_profile.backoffice_user_id
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
            ])
			->setTests("backoffice_user_id", "backoffice_user_id", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("backoffice_user_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("backoffice_user_id")
                ->name("backoffice_user_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}