<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;
use Module\NullosAdmin\FormModel\Control\AutoCompleteInputTextControl;
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
        $validator
			->setTests("commande_id", "commande_id", [
                RequiredControlTest::create(),
            ])
			->setTests("article_id", "article_id", [
                RequiredControlTest::create(),
            ])
			->setTests("fournisseur_id", "fournisseur_id", [
                RequiredControlTest::create(),
            ])
			->setTests("commande_ligne_statut_id", "commande_ligne_statut_id", [
                RequiredControlTest::create(),
            ])
			->setTests("unit", "unit", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("commande_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("commande_id")
                ->name("commande_id")
            )
            ->addControl("article_id", AutoCompleteInputTextControl::create()
                ->uri('/service/json/Ekom/autocomplete/auto/zilu.article')
                ->label("article_id")
                ->name("article_id")
            )
            ->addControl("container_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("container_id")
                ->name("container_id")
            )
            ->addControl("fournisseur_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("fournisseur_id")
                ->name("fournisseur_id")
            )
            ->addControl("sav_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("sav_id")
                ->name("sav_id")
            )
            ->addControl("commande_ligne_statut_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('')
                 
                ->label("commande_ligne_statut_id")
                ->name("commande_ligne_statut_id")
            )
            ->addControl("date_estimee", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => false])
                ->label("date_estimee")
                ->name("date_estimee")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}