<?php


use Authenticate\BadgeStore\FileBadgeStore;
use CrudGeneratorTools\CrudGenerator\ListCrudGeneratorHelper;
use CrudGeneratorTools\Helper\CrudGeneratorToolsHelper;
use CrudWithFile\CrudWithFile;
use ModelRenderers\DataTable\DataTableRenderer;
use Models\DataTable\DataTableModel;
use Module\AutoAdmin\AutoAdminModule;
use Output\WebProgramOutput;
use QuickPdo\QuickPdo;

require_once __DIR__ . "/../boot.php";




$model = DataTableModel::create();
/**
 * @var $model DataTableModel
 */
$model
    ->setRows([
        [
            "firstName" => "Mark",
            "lastName" => "Otto",
            "userName" => "@mdo",
        ],
        [
            "firstName" => "Jacob",
            "lastName" => "Thornton",
            "userName" => "@fat",
        ],
        [
            "firstName" => "Larry",
            "lastName" => "the Bird",
            "userName" => "@twitter",
        ],
        [
            "firstName" => "Shogun",
            "lastName" => "Mantra",
            "userName" => "@shotra",
        ],
        [
            "firstName" => "Aziz",
            "lastName" => "Bethune",
            "userName" => "@loopz",
        ],
        [
            "firstName" => "Gary",
            "lastName" => "Jaret",
            "userName" => "@gjwish",
        ],
        [
            "firstName" => "Mark",
            "lastName" => "Coulio",
            "userName" => "@coulio",
        ],
    ])
    ->setNbTotalItems(7);

echo DataTableRenderer::create()->setModel($model->getArray())->render();



az();

$m = new AutoAdminModule();
$m->setProgramOutput(WebProgramOutput::create());
$m->uninstall();

//a(FileBadgeStore::create()->setFile("/myphp/kaminos/app/store/Authenticate/profiles.php")->getBadges("root"));

az();
//--------------------------------------------
// PLAYGROUND
//--------------------------------------------
QuickPdo::setConnection("mysql:dbname=zilu;host=127.0.0.1", "root", "root", [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
]);


//az(CrudGeneratorToolsHelper::getRic("devis_has_commande_has_article"));


$gen = ListCrudGeneratorHelper::create()->setDatabases([
//    'oui',
    'zilu',
]);
$gen->setTable2foreignKeyPreferredColumn([
    'zilu.article' => 'reference_lf',
    'zilu.commande' => 'reference',
    'zilu.commande_ligne_statut' => 'nom',
    'zilu.container' => 'nom',
    'zilu.fournisseur' => 'nom',
    'zilu.sav' => 'fournisseur',
    'zilu.type_container' => 'label',
    'zilu.commande_has_article' => 'unit',
    'zilu.devis' => 'reference',
]);


// returns an array containing the fields and the joins involved in displaying a simple view of the oui.concours table
a($gen->getSqlQuery("zilu.container"));

echo nl2br($gen->getSqlQueryAsString("zilu.container"));

