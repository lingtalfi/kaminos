<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\TextAreaControl;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_cartPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_cart");
        $this->fields = '
ek_cart.id,
ek_cart.items,
ek_user.email
';
        $this->query = '
SELECT
%s
FROM kamille.ek_cart
inner join kamille.ek_user on kamille.ek_user.id=ek_cart.user_id
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
			->setTests("user_id", "user_id", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("items", TextAreaControl::create()
                ->label("items")
                ->name("items")
            )
            ->addControl("user_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, email from kamille.ek_user')
                 
                ->label("user_id")
                ->name("user_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}