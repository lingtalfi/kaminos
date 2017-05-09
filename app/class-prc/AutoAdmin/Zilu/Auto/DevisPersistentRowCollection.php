<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class DevisPersistentRowCollection extends QuickPdoPersistentRowCollection
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
        $validator
			->setTests("reference", "reference", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("reference", InputTextControl::create()
                ->label("reference")
                ->name("reference")
            )
            ->addControl("date_reception", InputTextControl::create()
                ->label("date_reception")
                ->name("date_reception")
            )
            ->addControl("fournisseur_id", InputTextControl::create()
                ->label("fournisseur_id")
                ->name("fournisseur_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}