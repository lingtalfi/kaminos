<?php



namespace Prc\AutoAdmin\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\InputSwitchControl;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_addressPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_address");
        $this->fields = '
ek_address.id,
ek_address.type,
ek_address.city,
ek_address.postcode,
ek_address.address,
ek_address.active,
ek_state.id,
ek_country.id
';
        $this->query = '
SELECT
%s
FROM kamille.ek_address
inner join kamille.ek_country on kamille.ek_country.id=ek_address.country_id
left join kamille.ek_state on kamille.ek_state.id=ek_address.state_id
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
			->setTests("type", "type", [
                RequiredControlTest::create(),
            ])
			->setTests("city", "city", [
                RequiredControlTest::create(),
            ])
			->setTests("postcode", "postcode", [
                RequiredControlTest::create(),
            ])
			->setTests("address", "address", [
                RequiredControlTest::create(),
            ])
			->setTests("country_id", "country_id", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("active", InputSwitchControl::create()
                ->label("active")
                ->name("active")
                ->addHtmlAttribute("value", "1")
            )
            ->addControl("state_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("state_id")
                ->name("state_id")
            )
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