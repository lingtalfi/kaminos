<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Commande_ligne_statutPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.commande_ligne_statut");
        $this->fields = '
commande_ligne_statut.id,
commande_ligne_statut.nom
';
        $this->query = '
SELECT
%s
FROM zilu.commande_ligne_statut
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
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        
    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}