<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;
use Module\NullosAdmin\FormModel\Control\AutoCompleteInputTextControl;
use FormModel\Control\InputTextControl;
use Module\NullosAdmin\FormModel\Control\DatetimePickerInputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Commande_has_articlePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.commande_has_article");
        $this->fields = '
commande_has_article.id,
commande.reference,
article.reference_lf,
container.nom,
fournisseur.nom,
sav.fournisseur,
commande_ligne_statut.nom,
commande_has_article.prix_override,
commande_has_article.date_estimee,
commande_has_article.quantite,
commande_has_article.unit
';
        $this->query = '
SELECT
%s
FROM zilu.commande_has_article
inner join zilu.article on zilu.article.id=commande_has_article.article_id
inner join zilu.commande on zilu.commande.id=commande_has_article.commande_id
inner join zilu.commande_ligne_statut on zilu.commande_ligne_statut.id=commande_has_article.commande_ligne_statut_id
inner join zilu.fournisseur on zilu.fournisseur.id=commande_has_article.fournisseur_id
left join zilu.container on zilu.container.id=commande_has_article.container_id
left join zilu.sav on zilu.sav.id=commande_has_article.sav_id
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
            ->addControl("commande_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, reference from zilu.commande')
                 
                ->label("commande_id")
                ->name("commande_id")
            )
            ->addControl("article_id", AutoCompleteInputTextControl::create()
                ->uri('/service/json/AutoAdmin/autocomplete/auto/zilu.article')
                ->label("article_id")
                ->name("article_id")
            )
            ->addControl("container_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, nom from zilu.container')
                ->firstOption("Please choose an option", 0) 
                ->label("container_id")
                ->name("container_id")
            )
            ->addControl("fournisseur_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, nom from zilu.fournisseur')
                 
                ->label("fournisseur_id")
                ->name("fournisseur_id")
            )
            ->addControl("sav_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, fournisseur from zilu.sav')
                ->firstOption("Please choose an option", 0) 
                ->label("sav_id")
                ->name("sav_id")
            )
            ->addControl("commande_ligne_statut_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, nom from zilu.commande_ligne_statut')
                 
                ->label("commande_ligne_statut_id")
                ->name("commande_ligne_statut_id")
            )
            ->addControl("prix_override", InputTextControl::create()
                ->label("prix_override")
                ->name("prix_override")
            )
            ->addControl("date_estimee", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => false])
                ->label("date_estimee")
                ->name("date_estimee")
            )
            ->addControl("quantite", InputTextControl::create()
                ->label("quantite")
                ->name("quantite")
            )
            ->addControl("unit", InputTextControl::create()
                ->label("unit")
                ->name("unit")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}