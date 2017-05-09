<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class Commande_has_articlePersistentRowCollection extends QuickPdoPersistentRowCollection
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
        $validator
			->setTests("unit", "unit", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("commande_id", InputTextControl::create()
                ->label("commande_id")
                ->name("commande_id")
            )
            ->addControl("article_id", InputTextControl::create()
                ->label("article_id")
                ->name("article_id")
            )
            ->addControl("container_id", InputTextControl::create()
                ->label("container_id")
                ->name("container_id")
            )
            ->addControl("fournisseur_id", InputTextControl::create()
                ->label("fournisseur_id")
                ->name("fournisseur_id")
            )
            ->addControl("sav_id", InputTextControl::create()
                ->label("sav_id")
                ->name("sav_id")
            )
            ->addControl("commande_ligne_statut_id", InputTextControl::create()
                ->label("commande_ligne_statut_id")
                ->name("commande_ligne_statut_id")
            )
            ->addControl("prix_override", InputTextControl::create()
                ->label("prix_override")
                ->name("prix_override")
            )
            ->addControl("date_estimee", InputTextControl::create()
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