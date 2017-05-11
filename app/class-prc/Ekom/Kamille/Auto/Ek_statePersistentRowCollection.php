<?php



namespace Prc\Ekom\Kamille\Auto;



use FormModel\Control\InputTextControl;
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
ek_country.iso_code
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
        
    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("iso_code", InputTextControl::create()
                ->label("iso_code")
                ->name("iso_code")
            )
            ->addControl("label", InputTextControl::create()
                ->label("label")
                ->name("label")
            )
            ->addControl("country_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, iso_code from kamille.ek_country')
                 
                ->label("country_id")
                ->name("country_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}