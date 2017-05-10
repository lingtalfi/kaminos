<?php

namespace CrudGeneratorTools\Skinny\Generator;


use Bat\FileSystemTool;
use CrudGeneratorTools\Skinny\Helper\SkinnyHelper;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Ling\Z;
use Kamille\Services\XLog;
use Module\AutoAdmin\CrudGenerator\Helper\AutoAdminCrudGeneratorHelper;
use QuickPdo\QuickPdoInfoTool;

class SkinnyModelGenerator implements SkinnyModelGeneratorInterface
{


    private $dstDir; // the dir where generated files are stored
    private $databases;
    private $cache;


    public function __construct()
    {
        $this->databases = null;
        $this->cache = [];
    }


    public static function create()
    {
        return new static();
    }

    public function generateFormModel($db, $table, array &$snippets, array &$uses)
    {
        if (false !== ($types = $this->getColTypes($db, $table))) {
            foreach ($types as $column => $type) {
                $p = explode('+', $type, 2);
                $typeId = $p[0];

                switch ($typeId) {
                    case 'auto_increment':

//                        $snippets[] = <<<EEE
//            ->addControl("$column", InputTextControl::create()
//                ->label("$column")
//                ->addHtmlAttribute("readonly", "readonly")
//                ->name("$column")
//            )
//EEE;
//                        $uses[] = 'FormModel\Control\InputTextControl';

                        break;
                    case 'input':
                        $snippets[] = <<<EEE
            ->addControl("$column", InputTextControl::create()
                ->label("$column")
                ->name("$column")
            )
EEE;
                        $uses[] = 'FormModel\Control\InputTextControl';
                        break;
                    case 'textarea':
                        $snippets[] = <<<EEE
            ->addControl("$column", HtmlTextAreaControl::create()
                ->label("$column")
                ->name("$column")
            )
EEE;
                        $uses[] = 'Module\NullosAdmin\FormModel\Control\HtmlTextAreaControl';
                        break;
                    case 'pass':
                        $snippets[] = <<<EEE
            ->addControl("$column", InputPasswordControl::create()
                ->label("$column")
                ->name("$column")
            )
EEE;
                        $uses[] = 'FormModel\Control\InputPasswordControl';
                        break;
                    case 'switch':
                        $snippets[] = <<<EEE
            ->addControl("$column", InputSwitchControl::create()
                ->label("$column")
                ->name("$column")
                ->addHtmlAttribute("value", "1")
            )
EEE;
                        $uses[] = 'Module\NullosAdmin\FormModel\Control\InputSwitchControl';
                        break;
                    case 'upload':
                        $params = SkinnyHelper::extractParams($type);
                        $profileId = $this->getParam('profileId', $params, $db, $table, $column);

                        $snippets[] = <<<EEE
            ->addControl("$column", DropZoneControl::create()
                ->setShowDeleteLink(true)
                ->setProfileId("$profileId")            
                ->label("$column")
                ->name("$column")
            )
EEE;
                        $uses[] = 'Module\NullosAdmin\FormModel\Control\DropZoneControl';


                        //--------------------------------------------
                        // CREATING AN UPLOAD PROFILE
                        //--------------------------------------------
                        $content = <<<EEE
<?php

use Kamille\Ling\Z;

\$appDir = Z::appDir();


\$profile = [
    "maxFileSize" => "10",
//  "acceptedFiles" => [
//      'application/pdf',
//  ],
    "targetDir" => \$appDir . "/www/uploads/$profileId",
];
EEE;


                        $p = explode('/', $profileId);
                        $last = array_pop($p);

                        $f = ApplicationParameters::get("app_dir") . "/config/upload-profiles/" . implode('/', $p) . '/auto/' . $last . '.php';
                        FileSystemTool::mkfile($f, $content);


                        break;
                    case 'autocomplete':
                        $params = SkinnyHelper::extractParams($type);
                        $uri = $this->getParam('uri', $params, $db, $table, $column);

                        $snippets[] = <<<EEE
            ->addControl("$column", AutoCompleteInputTextControl::create()
                ->uri('$uri')
                ->label("$column")
                ->name("$column")
            )
EEE;
                        $uses[] = 'Module\NullosAdmin\FormModel\Control\AutoCompleteInputTextControl';


                        /**
                         * Create the autocomplete file working with the autocomplete
                         * plugin used in nullosAdmin theme.
                         */
                        $fks = QuickPdoInfoTool::getForeignKeysInfo($table, $db);
                        if (array_key_exists($column, $fks)) {

                            $foreignKey = $fks[$column];
                            $fCol = $foreignKey[2];

                            $preferred = AutoAdminCrudGeneratorHelper::getForeignKeyPreferredColumn([$db]);
                            $fTable = $foreignKey[0] . "." . $foreignKey[1];
                            if (array_key_exists($fTable, $preferred)) {

                                $prefCol = $preferred[$fTable];


                                $c = <<<EEE
<?php


use QuickPdo\QuickPdo;

\$suggestions = QuickPdo::fetchAll('select $fCol as `data`, $prefCol as `value` from $fTable');
\$out = [
    'suggestions' => \$suggestions,
];



EEE;


                                $f = Z::appDir() . "/service/json/AutoAdmin/autocomplete/auto/$fTable.php";
                                FileSystemTool::mkfile($f, $c);

                            }

                        } else {
                            XLog::error("expected foreign key not found: $db.$table.$column");
                        }
                        break;
                    case 'date':
                        $snippets[] = <<<EEE
            ->addControl("$column", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => false])
                ->label("$column")
                ->name("$column")
            )
EEE;
                        $uses[] = 'Module\NullosAdmin\FormModel\Control\DatetimePickerInputTextControl';
                        break;
                    case 'datetime':
                        $snippets[] = <<<EEE
            ->addControl("$column", DatetimePickerInputTextControl::create()
                ->injectJsConfigurationKey(['timePicker' => true])
                ->label("$column")
                ->name("$column")
            )
EEE;
                        $uses[] = 'Module\NullosAdmin\FormModel\Control\DatetimePickerInputTextControl';
                        break;
                    case 'color':
                        $snippets[] = <<<EEE
            ->addControl("$column", ColorInputTextControl::create()
                ->label("$column")
                ->addHtmlAttribute("value", "#c00")
                ->name("$column")
            )
EEE;
                        $uses[] = 'Module\NullosAdmin\FormModel\Control\ColorInputTextControl';
                        break;
                    case 'selectForeignKey':
                        $params = SkinnyHelper::extractParams($type);
                        $query = $this->getParam('query', $params, $db, $table, $column);
                        $firstOption = "";
                        if (
                            array_key_exists("firstOptionLabel", $params) &&
                            array_key_exists("firstOptionValue", $params)
                        ) {
                            $label = $params['firstOptionLabel'];
                            $value = $params['firstOptionValue'];
                            $firstOption = '->firstOption("' . $label . '", ' . $value . ')';
                        }

                        $snippets[] = <<<EEE
            ->addControl("$column", SqlQuerySelectControl::create()
                //->multiple()
                ->query('$query')
                $firstOption 
                ->label("$column")
                ->name("$column")
            )
EEE;
                        $uses[] = 'Module\NullosAdmin\FormModel\Control\SqlQuerySelectControl';
                        break;
                    default:
                        break;
                }
            }
        }
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    public function setDstDir($dstDir)
    {
        $this->dstDir = $dstDir;
        return $this;
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    private function getColTypes($db, $table)
    {
        $fullTable = "$db.$table";
        if (!array_key_exists($fullTable, $this->cache)) {
            $f = $this->dstDir . "/" . $db . '.php';
            if (file_exists($f)) {
                $types = [];
                include $f;

                foreach ($types as $table => $col2Types) {
                    $this->cache["$db.$table"] = $col2Types;
                }
            } else {
                XLog::error("SkinnyModelGenerator: file not found: $f");
                return false;
            }
        }
        return $this->cache[$fullTable];
    }

    private function getParam($key, array $params, $db, $table, $column)
    {
        if (array_key_exists($key, $params)) {
            return $params[$key];
        } else {
            XLog::error("$key not set with column $db.$table.$column");
        }
        return false;
    }
}