<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Ek_currencyPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("kamille.ek_currency");
        $this->fields = '
ek_currency.id,
ek_currency.iso_code,
ek_currency.symbol,
ek_currency.exchange_rate
';
        $this->query = '
SELECT
%s
FROM kamille.ek_currency
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
        
    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("iso_code", InputTextControl::create()
                ->label("iso_code")
                ->name("iso_code")
            )
            ->addControl("symbol", InputTextControl::create()
                ->label("symbol")
                ->name("symbol")
            )
            ->addControl("exchange_rate", InputTextControl::create()
                ->label("exchange_rate")
                ->name("exchange_rate")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}