<?php


namespace Module\AutoAdmin\CrudGenerator;


use ArrayToString\ArrayToStringTool;
use Bat\FileSystemTool;
use CrudGeneratorTools\CrudGenerator\CrudGenerator;
use CrudGeneratorTools\Helper\CrudGeneratorToolsHelper;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Ling\Z;
use Module\AutoAdmin\AutoAdminHelper;


/**
 * This is the NullosCrudGenerator made by the AutoAdmin planet.
 */
class NullosCrudGenerator extends CrudGenerator
{

    private $module;

    public function __construct()
    {
        parent::__construct();
        $this->module = "AutoAdmin";
    }


    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }


    protected function doGenerateMenu(array $db2Tables)
    {
        $f = AutoAdminHelper::getGeneratedSideBarMenuPath();
        $m = $this->module;

        $items = [];
        foreach ($db2Tables as $db => $tables) {
            $tableItems = [];
            foreach ($tables as $table) {
                $tableItems[] = [
                    "label" => $table,
                    "link" => "/crud?type=list&prc=$m.$table",
                    "items" => null,
                    "icon" => '',
                ];
            }
            $items[] = [
                "icon" => "fa fa-database",
                "label" => $db,
                "items" => $tableItems,
            ];
        }


        $string = ArrayToStringTool::toPhpArray($items);


        $data = '<?php' . PHP_EOL;
        $data .= '$items = ' . $string . ';' . PHP_EOL . PHP_EOL;
        FileSystemTool::mkfile($f, $data);
    }


    protected function doGenerateItems(array $db2Tables)
    {
        foreach ($db2Tables as $db => $tables) {
            foreach ($tables as $table) {
                a("generating item: $db.$table");
                $this->generateDataTableProfile($db, $table);
                $this->generatePrc($db, $table);
            }
        }
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    private function generateDataTableProfile($db, $table)
    {
        $this->generateDataTableProfileManual($db, $table);
        $this->generateDataTableProfileAuto($db, $table);
    }

    private function generateDataTableProfileManual($db, $table)
    {
        $tpl = __DIR__ . "/../assets/config/datatable-profiles/manual.tpl.php";
        $c = file_get_contents($tpl);
        $c = str_replace([
            '{Module}',
            '{table}',
        ], [
            $this->module,
            $table,
        ], $c);


        $dst = Z::appDir() . "/config/datatable-profiles/" . $this->module . "/manual/$table.php";
        /**
         * Never overwrite a manual file
         */
        if (false === file_exists($dst)) {
            FileSystemTool::mkfile($dst, $c);
        }
    }

    private function generateDataTableProfileAuto($db, $table)
    {
        $tpl = __DIR__ . "/../assets/config/datatable-profiles/auto.tpl.php";

        $Table = ucfirst($table);
        $fullTable = "$db.$table";


        $headers = CrudGeneratorToolsHelper::getColumns($fullTable);
        $headers[] = 'action';

        $model = [
            'model' => [
                'headers' => $headers,
                'ric' => CrudGeneratorToolsHelper::getRic($fullTable),
                'actionButtons' => [
                    'addItem' => [
                        'label' => "Add $Table",
                    ],
                ],
            ],
        ];


        $c = file_get_contents($tpl);
        $c = str_replace([
            '{Module}',
            '{table}',
            '$model',
        ], [
            $this->module,
            $table,
            ArrayToStringTool::toPhpArray($model),
        ], $c);


        $dst = Z::appDir() . "/config/datatable-profiles/" . $this->module . "/auto/$table.php";
        FileSystemTool::mkfile($dst, $c);
    }


    private function generatePrc($db, $table)
    {

        az("stuck in . " . __FILE__);

        $d = AutoAdminHelper::getGeneratedPrcPath($this->module);
        $Table = ucfirst($table);
        $f = "$d/$Table" . "PersistentRowCollection.php";
        $data = $this->getPrcContent();

        FileSystemTool::mkfile($f, $data);


        $tpl = __DIR__ . "/../assets/config/datatable-profiles/auto.tpl.php";

        $Table = ucfirst($table);
        $fullTable = "$db.$table";

        $model = [
            'model' => [
                'headers' => CrudGeneratorToolsHelper::getColumns($fullTable),
                'ric' => CrudGeneratorToolsHelper::getRic($fullTable),
                'actionButtons' => [
                    'addItem' => [
                        'label' => "Add $Table",
                    ],
                ],
            ],
        ];


        $c = file_get_contents($tpl);
        $c = str_replace([
            '{Module}',
            '{table}',
            '$model',
        ], [
            $this->module,
            $table,
            ArrayToStringTool::toPhpArray($model),
        ], $c);


        $dst = Z::appDir() . "/config/datatable-profiles/" . $this->module . "/auto/$table.php";
        FileSystemTool::mkfile($dst, $c);
    }


    private function getPrcContent()
    {
        $s = '<?php ' . PHP_EOL;

        return $s;
    }
}
