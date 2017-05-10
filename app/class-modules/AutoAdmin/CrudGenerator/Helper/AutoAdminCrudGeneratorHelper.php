<?php


namespace Module\AutoAdmin\CrudGenerator\Helper;


use ArrayToString\ArrayToStringTool;
use Bat\FileSystemTool;
use CrudGeneratorTools\GeneratorGenerator\GeneratorGenerator;
use Kamille\Ling\Z;
use QuickPdo\QuickPdoInfoTool;

class AutoAdminCrudGeneratorHelper
{


    public static function generateForeignKeyPreferredColumns(array $databases = null)
    {
        $databases = self::getDatabases($databases);
        $path = Z::appDir() . "/store/AutoAdmin/foreignKeyPreferredColumns/generated.foreignKeyPreferredColumns.php";
        $arr = GeneratorGenerator::create()->generateForeignKeysPreferredColumnsByDatabase($databases);
        $sArr = ArrayToStringTool::toPhpArray($arr);
        $s = '<?php ' . PHP_EOL;
        $s .= '$preferredColumns = ';
        $s .= $sArr . ';' . PHP_EOL . PHP_EOL;
        FileSystemTool::mkfile($path, $s);
    }


    public static function getForeignKeyPreferredColumn(array $databases = null)
    {
        $path = Z::appDir() . "/store/AutoAdmin/foreignKeyPreferredColumns";
        $generatedPath = $path . '/generated.foreignKeyPreferredColumns.php';
        $manualPath = $path . '/foreignKeyPreferredColumns.php';
        $preferredColumns = [];
        if (file_exists($generatedPath)) {
            include $generatedPath;
        } else {
            if (file_exists($manualPath)) {
                include $manualPath;
            } else {
                self::generateForeignKeyPreferredColumns($databases);
                if (file_exists($generatedPath)) {
                    include $generatedPath;
                }
            }
        }
        return $preferredColumns;
    }


    public static function getDatabases(array $databases = null)
    {
        if (null === $databases) {
            $databases = QuickPdoInfoTool::getDatabases();
        }
        return $databases;
    }
}