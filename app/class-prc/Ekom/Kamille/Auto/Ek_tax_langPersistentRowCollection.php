<?php



namespace Prc\AutoAdmin\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_tax_langPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_tax_lang");
        $this->fields = '
ek_tax_lang.id,
ek_tax_lang.label,
ek_lang.id
';
        $this->query = '
SELECT
%s
FROM kamille.ek_tax_lang
inner join kamille.ek_lang on kamille.ek_lang.id=ek_tax_lang.lang_id
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
			->setTests("lang_id", "lang_id", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("lang_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("lang_id")
                ->name("lang_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}