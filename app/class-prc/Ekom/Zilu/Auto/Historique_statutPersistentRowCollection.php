<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\DatetimePickerInputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Historique_statutPersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.historique_statut");
        $this->fields = '
historique_statut.id,
historique_statut.date,
historique_statut.statut_nom,
historique_statut.reference_lf,
historique_statut.fournisseur_nom,
historique_statut.reference_fournisseur,
historique_statut.commande_reference,
historique_statut.commentaire,
historique_statut.commande_has_article_id
';
        $this->query = '
SELECT
%s
FROM zilu.historique_statut
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
			->setTests("statut_nom", "statut_nom", [
                RequiredControlTest::create(),
            ])
			->setTests("reference_lf", "reference_lf", [
                RequiredControlTest::create(),
            ])
			->setTests("fournisseur_nom", "fournisseur_nom", [
                RequiredControlTest::create(),
            ])
			->setTests("reference_fournisseur", "reference_fournisseur", [
                RequiredControlTest::create(),
            ])
			->setTests("commande_reference", "commande_reference", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("date", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => true])
                ->label("date")
                ->name("date")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}