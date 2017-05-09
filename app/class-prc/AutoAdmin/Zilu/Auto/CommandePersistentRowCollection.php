<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class CommandePersistentRowCollection extends QuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.commande");
        $this->fields = '
commande.id,
commande.reference
';
        $this->query = '
SELECT
%s
FROM zilu.commande
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
			->setTests("reference", "reference", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("reference", InputTextControl::create()
                ->label("reference")
                ->name("reference")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}