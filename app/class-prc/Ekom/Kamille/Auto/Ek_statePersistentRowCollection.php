<?php



namespace Prc\AutoAdmin\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_statePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_state");
        $this->fields = '
ek_state.id,
ek_state.iso_code,
ek_state.label,
ek_country.id
';
        $this->query = '
SELECT
%s
FROM kamille.ek_state
inner join kamille.ek_country on kamille.ek_country.id=ek_state.country_id
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
			->setTests("iso_code", "iso_code", [
                RequiredControlTest::create(),
            ])
			->setTests("label", "label", [
                RequiredControlTest::create(),
            ])
			->setTests("country_id", "country_id", [
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
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}