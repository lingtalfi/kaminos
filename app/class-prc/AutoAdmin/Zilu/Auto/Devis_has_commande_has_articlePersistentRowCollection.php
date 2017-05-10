<?php



namespace Prc\AutoAdmin\Zilu\Auto;



use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl;

use FormModel\FormModel;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use PersistentRowCollection\QuickPdoPersistentRowCollection;


class Devis_has_commande_has_articlePersistentRowCollection extends QuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.devis_has_commande_has_article");
        $this->fields = '
devis_has_commande_has_article.devis_id,
devis_has_commande_has_article.commande_has_article_id,
devis.reference,
commande_has_article.unit
';
        $this->query = '
SELECT
%s
FROM zilu.devis_has_commande_has_article
inner join zilu.commande_has_article on zilu.commande_has_article.id=devis_has_commande_has_article.commande_has_article_id
inner join zilu.devis on zilu.devis.id=devis_has_commande_has_article.devis_id
';
    }


    public function getRic()
    {
        return [
    'devis_id',
    'commande_has_article_id',
];
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function decorateFormModelValidator(ControlsValidator $validator)
    {
        $validator
			->setTests("devis_id", "devis_id", [
                RequiredControlTest::create(),
            ])
			->setTests("commande_has_article_id", "commande_has_article_id", [
                RequiredControlTest::create(),
            ]);

    }

    protected function decorateFormModel(FormModel $model)
    {
        $model
            ->addControl("devis_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, reference from zilu.devis')
                 
                ->label("devis_id")
                ->name("devis_id")
            )
            ->addControl("commande_has_article_id", SqlQuerySelectControl::create()
                //->multiple()
                ->query('select id, unit from zilu.commande_has_article')
                 
                ->label("commande_has_article_id")
                ->name("commande_has_article_id")
            );

    }

    protected function getAutoIncrementedColumn()
    {
        return null;
    }
}