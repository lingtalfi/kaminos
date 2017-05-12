<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_shopPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_shop");
        $this->fields = '
ek_shop.id,
ek_shop.label,
ek_lang.label,
ek_currency.iso_code,
ek_timezone.name
';
        $this->query = '
SELECT
%s
FROM kamille.ek_shop
left join kamille.ek_currency on kamille.ek_currency.id=ek_shop.currency_id
left join kamille.ek_lang on kamille.ek_lang.id=ek_shop.lang_id
left join kamille.ek_timezone on kamille.ek_timezone.id=ek_shop.timezone_id
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
            ->addControl("label", InputTextControl::create()
                ->label("label")
                ->name("label")
            )
            ->addControl("lang_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, label from kamille.ek_lang')
                ->firstOption("Please choose an option", 0) 
                ->label("lang_id")
                ->name("lang_id")
            )
            ->addControl("currency_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, iso_code from kamille.ek_currency')
                ->firstOption("Please choose an option", 0) 
                ->label("currency_id")
                ->name("currency_id")
            )
            ->addControl("timezone_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, name from kamille.ek_timezone')
                ->firstOption("Please choose an option", 0) 
                ->label("timezone_id")
                ->name("timezone_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}