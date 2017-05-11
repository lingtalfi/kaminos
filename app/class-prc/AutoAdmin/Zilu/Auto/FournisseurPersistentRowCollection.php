<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class FournisseurPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
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