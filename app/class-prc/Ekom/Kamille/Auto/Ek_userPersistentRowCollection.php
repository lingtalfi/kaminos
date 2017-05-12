<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;
use FormModel\Control\InputTextControl;
use FormModel\Control\InputPasswordControl;
use Module\NullosAdmin\FormModel\Control\DatetimePickerInputTextControl;
use Module\NullosAdmin\FormModel\Control\InputSwitchControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_userPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_user");
        $this->fields = '
ek_user.id,
ek_user_group.label,
ek_user.email,
ek_user.pass,
ek_user.base_shop_id,
ek_user.date_creation,
ek_user.active,
ek_address.type,
ek_user.mobile,
ek_user.phone,
ek_user.pro
';
        $this->query = '
SELECT
%s
FROM kamille.ek_user
inner join kamille.ek_address on kamille.ek_address.id=ek_user.main_address_id
inner join kamille.ek_user_group on kamille.ek_user_group.id=ek_user.user_group_id
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
			->setTests("user_group_id", "user_group_id", [
                RequiredControlTest::create(),
            ])
			->setTests("email", "email", [
                RequiredControlTest::create(),
            ])
			->setTests("pass", "pass", [
                RequiredControlTest::create(),
            ])
			->setTests("main_address_id", "main_address_id", [
                RequiredControlTest::create(),
            ])
			->setTests("mobile", "mobile", [
                RequiredControlTest::create(),
            ])
			->setTests("phone", "phone", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("user_group_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_user_group')
                 
                ->label("user_group_id")
                ->name("user_group_id")
            )
            ->addControl("email", InputTextControl::create()
                ->label("email")
                ->name("email")
            )
            ->addControl("pass", InputPasswordControl::create()
                ->label("pass")
                ->name("pass")
            )
            ->addControl("base_shop_id", InputTextControl::create()
                ->label("base_shop_id")
                ->name("base_shop_id")
            )
            ->addControl("date_creation", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => true])
                ->label("date_creation")
                ->name("date_creation")
            )
            ->addControl("active", InputSwitchControl::create()
                ->label("active")
                ->name("active")
                ->addHtmlAttribute("value", "1")
            )
            ->addControl("main_address_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, type from kamille.ek_address')
                 
                ->label("main_address_id")
                ->name("main_address_id")
            )
            ->addControl("mobile", InputTextControl::create()
                ->label("mobile")
                ->name("mobile")
            )
            ->addControl("phone", InputTextControl::create()
                ->label("phone")
                ->name("phone")
            )
            ->addControl("pro", InputSwitchControl::create()
                ->label("pro")
                ->name("pro")
                ->addHtmlAttribute("value", "1")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}