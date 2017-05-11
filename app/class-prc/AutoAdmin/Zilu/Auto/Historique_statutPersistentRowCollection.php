<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use Module\NullosAdmin\FormModel\Control\DatetimePickerInputTextControl;
use FormModel\Control\InputTextControl;
use FormModel\Control\TextAreaControl;

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
        
    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("date", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => true])
                ->label("date")
                ->name("date")
            )
            ->addControl("statut_nom", InputTextControl::create()
                ->label("statut_nom")
                ->name("statut_nom")
            )
            ->addControl("reference_lf", InputTextControl::create()
                ->label("reference_lf")
                ->name("reference_lf")
            )
            ->addControl("fournisseur_nom", InputTextControl::create()
                ->label("fournisseur_nom")
                ->name("fournisseur_nom")
            )
            ->addControl("reference_fournisseur", InputTextControl::create()
                ->label("reference_fournisseur")
                ->name("reference_fournisseur")
            )
            ->addControl("commande_reference", InputTextControl::create()
                ->label("commande_reference")
                ->name("commande_reference")
            )
            ->addControl("commentaire", TextAreaControl::create()
                ->label("commentaire")
                ->name("commentaire")
            )
            ->addControl("commande_has_article_id", InputTextControl::create()
                ->label("commande_has_article_id")
                ->name("commande_has_article_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}