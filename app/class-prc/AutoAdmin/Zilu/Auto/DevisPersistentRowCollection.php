<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Control\InputTextControl;
use Module\NullosAdmin\FormModel\Control\DatetimePickerInputTextControl;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class DevisPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.devis");
        $this->fields = '
devis.id,
devis.reference,
devis.date_reception,
fournisseur.nom
';
        $this->query = '
SELECT
%s
FROM zilu.devis
inner join zilu.fournisseur on zilu.fournisseur.id=devis.fournisseur_id
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
            ->addControl("reference", InputTextControl::create()
                ->label("reference")
                ->name("reference")
            )
            ->addControl("date_reception", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => false])
                ->label("date_reception")
                ->name("date_reception")
            )
            ->addControl("fournisseur_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, nom from zilu.fournisseur')
                 
                ->label("fournisseur_id")
                ->name("fournisseur_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}