<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_user_groupPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_user_group");
        $this->fields = '
ek_user_group.id,
ek_user_group.label
';
        $this->query = '
SELECT
%s
FROM kamille.ek_user_group
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
            ->addControl("id", InputTextControl::create()
                ->label("id")
                ->name("id")
            )
            ->addControl("label", InputTextControl::create()
                ->label("label")
                ->name("label")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return null;
    }
}