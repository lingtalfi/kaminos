<?php


namespace Module\AutoAdmin\CrudGenerator\Skinny\Generator;


use Bat\FileSystemTool;
use CrudGeneratorTools\Skinny\Generator\SkinnyModelGenerator;
use CrudGeneratorTools\Skinny\Helper\SkinnyHelper;
use CrudGeneratorTools\Util\ForeignKeyPreferredColumnUtil;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Ling\Z;
use Kamille\Services\XLog;
use Module\AutoAdmin\CrudGenerator\Util\NullosForeignKeyPreferredColumnUtil;
use QuickPdo\Util\QuickPdoInfoCacheUtil;

class NullosSkinnyModelGenerator extends SkinnyModelGenerator
{

    /**
     * @var ForeignKeyPreferredColumnUtil $foreignKeyPreferredColumnUtil
     */
    private $foreignKeyPreferredColumnUtil;

    /**
     * @var QuickPdoInfoCacheUtil $quickPdoInfoCache
     */
    private $quickPdoInfoCache;


    public function setForeignKeyPreferredColumnUtil(ForeignKeyPreferredColumnUtil $foreignKeyPreferredColumnUtil)
    {
        $this->foreignKeyPreferredColumnUtil = $foreignKeyPreferredColumnUtil;
        return $this;
    }

    public function setQuickPdoInfoCache(QuickPdoInfoCacheUtil $quickPdoInfoCache)
    {
        $this->quickPdoInfoCache = $quickPdoInfoCache;
        return $this;
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function prepare()
    {
        parent::prepare();
        if (null === $this->foreignKeyPreferredColumnUtil) {
            $this->foreignKeyPreferredColumnUtil = NullosForeignKeyPreferredColumnUtil::create();
        }
        if (null === $this->quickPdoInfoCache) {
            $this->quickPdoInfoCache = QuickPdoInfoCacheUtil::create()->cache($this->_useCache);
        }
        if (null === $this->skinnyTypeUtil) {
            $this->skinnyTypeUtil = NullosSkinnyTypeUtil::create();
        }
    }

    protected function generateFormControlModel($typeId, $type, $column, $db, $table, array &$snippets, array &$uses)
    {
        switch ($typeId) {
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
                $fks = $this->quickPdoInfoCache->getForeignKeysInfo($table, $db);
                if (array_key_exists($column, $fks)) {

                    $foreignKey = $fks[$column];
                    $fCol = $foreignKey[2];

                    $prefCol = $this->foreignKeyPreferredColumnUtil->getPreferredForeignKey($foreignKey[0], $foreignKey[1], $this->_useCache);
                    if (false !== $prefCol) {


                        $fTable = $foreignKey[0] . '.' . $foreignKey[1];

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
                parent::generateFormControlModel($typeId, $type, $column, $db, $table, $snippets, $uses);
                break;
        }
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