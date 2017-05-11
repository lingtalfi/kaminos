<?php



namespace Prc\AutoAdmin\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_country_langPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_country_lang");
        $this->fields = '
ek_country_lang.country_id,
ek_country_lang.lang_id,
ek_country_lang.label,
ek_country.id,
ek_lang.id
';
        $this->query = '
SELECT
%s
FROM kamille.ek_country_lang
inner join kamille.ek_country on kamille.ek_country.id=ek_country_lang.country_id
inner join kamille.ek_lang on kamille.ek_lang.id=ek_country_lang.lang_id
';
    }


    public function getRic()
    {
        return [
    'country_id',
    'lang_id',
    'label',
];
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function decorateFormModelValidator(ControlsValidator $validator)
    {
        $validator
			->setTests("country_id", "country_id", [
                RequiredControlTest::create(),
            ])
			->setTests("lang_id", "lang_id", [
                RequiredControlTest::create(),
            ])
			->setTests("label", "label", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("country_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("country_id")
                ->name("country_id")
            )
            ->addControl("lang_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("lang_id")
                ->name("lang_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return null;
    }
}