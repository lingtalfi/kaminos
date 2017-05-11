<?php



namespace Prc\AutoAdmin\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_taxPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_tax");
        $this->fields = '
ek_tax.id,
ek_tax.reduction,
ek_tax_lang.id
';
        $this->query = '
SELECT
%s
FROM kamille.ek_tax
inner join kamille.ek_tax_lang on kamille.ek_tax_lang.id=ek_tax.tax_lang_id
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
			->setTests("reduction", "reduction", [
                RequiredControlTest::create(),
            ])
			->setTests("tax_lang_id", "tax_lang_id", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("tax_lang_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("tax_lang_id")
                ->name("tax_lang_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}