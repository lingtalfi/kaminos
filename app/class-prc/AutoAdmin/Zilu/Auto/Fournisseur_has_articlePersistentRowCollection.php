<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;
use Module\NullosAdmin\FormModel\Control\AutoCompleteInputTextControl;
use FormModel\Control\InputTextControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use Module\NullosAdmin\PersistentRowCollection\NullosQuickPdoPersistentRowCollection;


class Fournisseur_has_articlePersistentRowCollection extends NullosQuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.fournisseur_has_article");
        $this->fields = '
fournisseur_has_article.fournisseur_id,
fournisseur_has_article.article_id,
fournisseur.nom,
article.reference_lf,
fournisseur_has_article.reference,
fournisseur_has_article.prix,
fournisseur_has_article.volume,
fournisseur_has_article.poids
';
        $this->query = '
SELECT
%s
FROM zilu.fournisseur_has_article
inner join zilu.article on zilu.article.id=fournisseur_has_article.article_id
inner join zilu.fournisseur on zilu.fournisseur.id=fournisseur_has_article.fournisseur_id
';
    }


    public function getRic()
    {
        return [
    'fournisseur_id',
    'article_id',
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
            ->addControl("fournisseur_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, nom from zilu.fournisseur')
                 
                ->label("fournisseur_id")
                ->name("fournisseur_id")
            )
            ->addControl("article_id", AutoCompleteInputTextControl::create()
                ->uri('/service/json/AutoAdmin/autocomplete/auto/zilu.article')
                ->label("article_id")
                ->name("article_id")
            )
            ->addControl("reference", InputTextControl::create()
                ->label("reference")
                ->name("reference")
            )
            ->addControl("prix", InputTextControl::create()
                ->label("prix")
                ->name("prix")
            )
            ->addControl("volume", InputTextControl::create()
                ->label("volume")
                ->name("volume")
            )
            ->addControl("poids", InputTextControl::create()
                ->label("poids")
                ->name("poids")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return null;
    }
}