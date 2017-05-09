<?php


namespace Prc\AutoAdmin;


use FormModel\Control\InputPasswordControl;
use FormModel\Control\InputTextControl;
use FormModel\Control\TextAreaControl;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use FormModel\Validation\ControlTest\WithFields\MinCharControlTest;
use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;
use Module\NullosAdmin\FormModel\NullosFormModel;
use PersistentRowCollection\InteractivePersistentRowCollectionInterface;
use PersistentRowCollection\QuickPdoPersistentRowCollection;
use RowsGenerator\QuickPdoRowsGenerator;

class ArticlePersistentRowCollection extends QuickPdoPersistentRowCollection
{
    public function __construct()
    {
        parent::__construct();
        $this->setTable("zilu.article");
    }


    public function getForm($type)
    {

        $validator = ControlsValidator::create()
            ->setTests("reference_lf", "reference_lf", [
                RequiredControlTest::create(),
                MinCharControlTest::create()->min(5),
            ]);


        $m = NullosFormModel::create()->setValidator($validator);
        if ('insert' !== $type) {
            $m->addControl("id", InputTextControl::create()
                ->addHtmlAttribute(null, "disabled")
                ->label("id")
                ->name("id")
            );
        }
        return $m
            ->addControl("reference_lf", InputTextControl::create()
                ->label("reference_lf")
                ->name("reference_lf")
            )
            ->addControl("reference_hldp", InputTextControl::create()
                ->label("reference_hldp")
                ->name("reference_hldp")
            )
            ->addControl("descr_fr", TextAreaControl::create()
                ->label("descr_fr")
                ->name("descr_fr")
            )
            ->addControl("descr_en", TextAreaControl::create()
                ->label("descr_en")
                ->name("descr_en")
            )
            ->addControl("ean", InputTextControl::create()
                ->label("ean")
                ->name("ean")
            )
            ->addControl("photo", InputTextControl::create()
                ->label("photo")
                ->name("photo")
            )
            ->addControl("logo", InputTextControl::create()
                ->label("logo")
                ->name("logo")
            )
            ->addControl("long_desc_en", TextAreaControl::create()
                ->label("long_desc_en")
                ->name("long_desc_en")
            );
    }


    public function read(&$page, $nipp, array $searchValues = [], array $sortValues = [], &$nbTotalItems = 0)
    {
        $g = QuickPdoRowsGenerator::create()
            ->setFields('
article.id,            
article.reference_lf,            
article.reference_hldp,            
article.descr_fr,            
article.descr_en,            
article.ean,            
article.photo,            
article.logo,            
article.long_desc_en            
            ')
            ->setQuery('
SELECT 
%s 
FROM 
zilu.article
            ')
            ->setPage($page)
            ->setSortValues($sortValues)
            ->setSearchItems($searchValues)
            ->setNbItemsPerPage($nipp);

        $ret = $g->getRows();
        $page = $g->getPage();
        $nbTotalItems = $g->getNbTotalItems();
        return $ret;
    }

    public function readByRic($ric)
    {
        return [
            "id" => 6,
            "name" => "Jean-Louis",
            "pass" => "tamere",
            "profile" => "tarace",
        ];
    }


    public function update(array $ric, array $newRow)
    {
        // TODO: Implement update() method.
    }

    public function delete(array $ric)
    {
        return true;
    }

    public function getRic()
    {
        return ["id"];
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function getAutoIncrementedColumn()
    {
        return 'id';
    }
}