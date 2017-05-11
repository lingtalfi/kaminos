<?php


namespace Module\AutoAdmin\CrudGenerator;


use ArrayToString\ArrayToStringTool;
use Bat\FileSystemTool;
use CrudGeneratorTools\CrudGenerator\CrudGenerator;
use CrudGeneratorTools\GeneratorGenerator\GeneratorGenerator;
use CrudGeneratorTools\Helper\CrudGeneratorToolsHelper;
use CrudGeneratorTools\Skinny\Generator\SkinnyTypeGenerator;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Ling\Z;
use Module\AutoAdmin\AutoAdminHelper;
use Module\AutoAdmin\CrudGenerator\Helper\AutoAdminCrudGeneratorHelper;
use Module\AutoAdmin\CrudGenerator\Skinny\Generator\NullosSkinnyModelGenerator;
use Module\AutoAdmin\CrudGenerator\Skinny\Generator\NullosSkinnyTypeGenerator;
use QuickPdo\QuickPdo;
use QuickPdo\QuickPdoInfoTool;

/**
 * Todo: doc for generating cruds
 * /myphp/kaminos/app/store/AutoAdmin/foreignKeyPreferredColumns/generated.foreignKeyPreferredColumns.php
 * /myphp/kaminos/app/store/AutoAdmin/foreignKeyPreferredColumns/foreignKeyPreferredColumns.php
 */

/**
 * This is the NullosCrudGenerator made by the AutoAdmin planet.
 */
class NullosCrudGeneratorCopy extends CrudGenerator
{

    private $module;
    /**
     * @var NullosSkinnyModelGenerator
     */
    private $modelGen;
    //
    private $table2Nullables;
    private $table2DataType;
    private $table2AutoInc;
    private $table2Fks;


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

    public function generate()
    {
        foreach ($this->databases as $db) {
            AutoAdminCrudGeneratorHelper::generateForeignKeyPreferredColumns($db);
        }


        /**
         * Prepare types
         * @var $typeGen NullosSkinnyTypeGenerator
         */
        $typeGen = NullosSkinnyTypeGenerator::create()->setModule($this->module)->setDatabases($this->databases);
        $typeGen->generate();

        $this->modelGen = NullosSkinnyModelGenerator::create();
        parent::generate();
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    protected function getForeignKeyPreferredColumn($foreignSchema, $foreignTable, $foreignColumn, $hostSchema, $hostTable, $hostColumn)
    {
        $tables = AutoAdminCrudGeneratorHelper::getForeignKeyPreferredColumn($foreignSchema);
        if (array_key_exists($foreignTable, $tables)) {
            return $foreignTable . "." . $tables[$foreignTable];
        }
        return $foreignTable . "." . $foreignColumn;
    }


    protected function doGenerateMenu(array $db2Tables)
    {
        $dir = AutoAdminHelper::getGeneratedSideBarMenuPath() . "/auto";
        $m = $this->module;


        foreach ($db2Tables as $db => $tables) {

            $f = $dir . "/$db.php";

            $tableItems = [];
            foreach ($tables as $table) {
                $tableItems[] = [
                    "label" => $table,
                    "link" => "/crud?type=list&prc=$m.$db.$table",
                    "items" => null,
                    "icon" => '',
                ];
            }
            $items = [
                "icon" => "fa fa-database",
                "label" => $db,
                "items" => $tableItems,
            ];


            $string = ArrayToStringTool::toPhpArray($items);


            $data = '<?php' . PHP_EOL;
            $data .= '$items = ' . $string . ';' . PHP_EOL . PHP_EOL;
            FileSystemTool::mkfile($f, $data);
        }
    }


    protected function doGenerateItems(array $db2Tables)
    {

        foreach ($db2Tables as $db => $tables) {
            foreach ($tables as $table) {
                $column2DataType = QuickPdoInfoTool::getColumnDataTypes($db . '.' . $table);
                $column2Nullable = QuickPdoInfoTool::getColumnNullabilities($db . '.' . $table);
                $autoIncField = QuickPdoInfoTool::getAutoIncrementedField($db . '.' . $table);
                $fks = QuickPdoInfoTool::getForeignKeysInfo($table, $db);


                $this->table2DataType[$db . '.' . $table] = $column2DataType;
                $this->table2Nullables[$db . '.' . $table] = $column2Nullable;
                $this->table2AutoInc[$db . '.' . $table] = $autoIncField;
                $this->table2Fks[$db . '.' . $table] = $fks;


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
        $this->generateDataTableProfileAuto($db, $table);
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
            '{db}',
        ], [
            $this->module,
            $table,
            ArrayToStringTool::toPhpArray($model),
            $db,
        ], $c);


        $dst = Z::appDir() . "/config/datatable-profiles/" . $this->module . "/auto/$db/$table.php";
        FileSystemTool::mkfile($dst, $c);
    }


    private function generatePrc($db, $table)
    {
        $tpl = __DIR__ . "/../assets/class-prc/ExamplePersistentRowCollection.tpl.php";
        $content = file_get_contents($tpl);
        $uses = [];


        $fullTable = $db . '.' . $table;
        $Table = ucfirst($table);

        list($prefixedColumns, $joins) = $this->getSqlQuery($fullTable);
        $fields = PHP_EOL . implode(',' . PHP_EOL, $prefixedColumns) . PHP_EOL;

        $q = PHP_EOL . "SELECT" . PHP_EOL;
        $q .= "%s" . PHP_EOL;
        $q .= "FROM $db.$table" . PHP_EOL;
        if (count($joins[0]) > 0) {
            $q .= implode(PHP_EOL, $joins[0]) . PHP_EOL;
        }
        if (count($joins[1]) > 0) {
            $q .= implode(PHP_EOL, $joins[1]) . PHP_EOL;
        }


        $ric = CrudGeneratorToolsHelper::getRic($fullTable);
        $sRic = ArrayToStringTool::toPhpArray($ric);
        $module = $this->module;
        $snippets = [];
        $this->generateFormModelValidator($db, $table, $snippets, $uses);
        $sValidator = '';
        if (count($snippets) > 0) {
            $sValidator .= '$validator';
            foreach ($snippets as $snippet) {
                $sValidator .= PHP_EOL . str_repeat("\t", 3) . $snippet;
            }
            $sValidator .= ';' . PHP_EOL;
        }


        $sModel = '';
        $snippets = [];
        $this->modelGen->generateFormModel($db, $table, $snippets, $uses);

        if (count($snippets) > 0) {
            $sModel .= '$model';
            foreach ($snippets as $snippet) {
                $sModel .= PHP_EOL . $snippet;
            }
            $sModel .= ';' . PHP_EOL;
        }


        $uses = array_unique($uses);
        $sUse = 'use ' . implode(';' . PHP_EOL . 'use ', $uses) . ';' . PHP_EOL;


        $aic = 'null';
        if (false !== ($autoInc = QuickPdoInfoTool::getAutoIncrementedField($table, $db))) {
            $aic = "'$autoInc'";
        }

        $Db = ucfirst($db);

        $namespace = 'namespace Prc\AutoAdmin\\' . $Db . '\Auto;' . PHP_EOL;
        $tags = [
            'ExamplePersistentRowCollection' => $Table . 'PersistentRowCollection',
            '{db}' => $db,
            '{table}' => $table,
            '{fields}' => $fields,
            '{query}' => $q,
            '$ric' => $sRic,
            '//-validator' => $sValidator,
            '//-model' => $sModel,
            '$aic' => $aic,
            '//-use' => $sUse,
            '//-namespace' => $namespace,
        ];

        $c = str_replace(array_keys($tags), array_values($tags), $content);
        $dst = Z::appDir() . "/class-prc/$module/$Db/Auto/$Table" . "PersistentRowCollection.php";
        FileSystemTool::mkfile($dst, $c);
    }

    private function generateFormModelValidator($db, $table, array &$snippets, array &$uses)
    {
        /**
         * By default, we will generate the following:
         * - required on every non nullable varchar
         */
        $datatypes = $this->table2DataType[$db . '.' . $table];
        $fks = $this->table2Fks[$db . '.' . $table];

//        if ('container' === $table) {
//            az($datatypes);
//        }


        $nullables = $this->table2Nullables[$db . '.' . $table];
        foreach ($datatypes as $column => $datatype) {
            if ('varchar' === $datatype) {
                if (false === $nullables[$column]) {
                    $snippets[] = <<<EEE
->setTests("$column", "$column", [
                RequiredControlTest::create(),
            ])
EEE;

                    $uses[] = 'FormModel\Validation\ControlTest\WithFields\RequiredControlTest';
                }
            } elseif (
                /**
                 * Foreign keys?
                 */
                'int' === $datatype &&
                false === $nullables[$column] &&
                array_key_exists($column, $fks)
            ) {
                $snippets[] = <<<EEE
->setTests("$column", "$column", [
                RequiredControlTest::create(),
            ])
EEE;

                $uses[] = 'FormModel\Validation\ControlTest\WithFields\RequiredControlTest';
            }
        }

    }


    protected function getFormForeignKeySelectorLabel(array $row)
    {

    }
}
