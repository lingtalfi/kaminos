<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;
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
ek_backoffice_user.email
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
            ->addControl("label", InputTextControl::create()
                ->label("label")
                ->name("label")
            )
            ->addControl("backoffice_user_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, email from kamille.ek_backoffice_user')
                 
                ->label("backoffice_user_id")
                ->name("backoffice_user_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}