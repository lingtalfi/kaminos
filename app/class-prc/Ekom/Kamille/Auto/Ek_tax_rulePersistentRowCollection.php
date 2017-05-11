<?php



namespace Prc\AutoAdmin\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_tax_rulePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_tax_rule");
        $this->fields = '
ek_tax_rule.id,
ek_tax.id,
ek_tax_rule.condition
';
        $this->query = '
SELECT
%s
FROM kamille.ek_tax_rule
inner join kamille.ek_tax on kamille.ek_tax.id=ek_tax_rule.tax_id
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
			->setTests("tax_id", "tax_id", [
                RequiredControlTest::create(),
            ])
			->setTests("condition", "condition", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("tax_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("tax_id")
                ->name("tax_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}