<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class FournisseurPersistentRowCollection extends QuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.fournisseur");
        $this->fields = '
fournisseur.id,
fournisseur.nom,
fournisseur.email
';
        $this->query = '
SELECT
%s
FROM zilu.fournisseur
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
			->setTests("nom", "nom", [
                RequiredControlTest::create(),
            ])
			->setTests("email", "email", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("nom", InputTextControl::create()
                ->label("nom")
                ->name("nom")
            )
            ->addControl("email", InputTextControl::create()
                ->label("email")
                ->name("email")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}