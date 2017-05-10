<?php

namespace CrudGeneratorTools\Skinny\Generator;


use ArrayToString\ArrayToStringTool;
use Bat\FileSystemTool;
use QuickPdo\QuickPdo;
use QuickPdo\QuickPdoInfoTool;

class SkinnyTypeGenerator implements SkinnyTypeGeneratorInterface
{
    protected $dstDir;
    protected $databases;
    protected $module;

    public function __construct()
    {
        $this->databases = null;
    }


    public static function create()
    {
        return new static();
    }

    public function generate()
    {
        $this->check();
        $dbs = $this->databases;
        if (null === $dbs) {
            $dbs = QuickPdoInfoTool::getDatabases();
        }

        foreach ($dbs as $db) {
            $this->generateDb($db);
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

    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }

    public function setDatabases(array $databases)
    {
        $this->databases = $databases;
        return $this;
    }

    public function getTable2Types($db)
    {
        $tables = QuickPdoInfoTool::getTables($db);
        $table2Types = [];
        foreach ($tables as $table) {
            $types = QuickPdoInfoTool::getColumnDataTypes($db . "." . $table);
            $detailedTypes = QuickPdoInfoTool::getColumnDataTypes($db . "." . $table, true);
            $fks = QuickPdoInfoTool::getForeignKeysInfo($table, $db);
            $nullables = QuickPdoInfoTool::getColumnNullabilities($db . "." . $table);
            $autoIncField = QuickPdoInfoTool::getAutoIncrementedField($db . '.' . $table);

            $column2SkinnyType = [];
            foreach ($types as $column => $type) {


                $detailedType = $detailedTypes[$column];
                $isAutoInc = ($column === $autoIncField);
                $foreignKey = (array_key_exists($column, $fks)) ? $fks[$column] : null;
                $isNullable = $nullables[$column];

                if (false !== $skinnyType = ($this->getSkinnyType($column, $table, $db, $type, $detailedType, $isAutoInc, $foreignKey, $isNullable))) {
                    $column2SkinnyType[$column] = $skinnyType;
                }
            }
            $table2Types[$table] = $column2SkinnyType;
        }
        return $table2Types;
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function generateDb($db)
    {
        $table2Types = $this->getTable2Types($db);
        $sItems = ArrayToStringTool::toPhpArray($table2Types);
        $c = <<<EEE
<?php

\$types = $sItems;

EEE;

        $f = $this->dstDir . "/$db.php";
        FileSystemTool::mkfile($f, $c);
    }


    protected function getSkinnyType($column, $table, $db, $type, $detailedType, $isAutoInc, $foreignKey, $isNullable)
    {
        $ret = false;
        if (true === $isAutoInc) {
            $ret = 'auto_increment';
        } else {
            if (null !== $foreignKey) {
                $fDb = $foreignKey[0];
                $fTable = $foreignKey[1];


                $lotOfItems = false;

                $q = "select count(*) as count from $fDb.$fTable";
                if (false !== ($ret = QuickPdo::fetch($q))) {
                    $nbItems = $ret["count"];
                    if ($nbItems > 365) {
                        $lotOfItems = true;
                    }
                }
                if (false === $lotOfItems) {
                    $ret = "selectForeignKey";
                } else {
                    $ret = "autocomplete";
                }
            } else {
                switch ($type) {
                    case 'text':
                        $ret = 'textarea';
                        break;
                    case 'date':
                        $ret = 'date';
                        break;
                    case 'datetime':
                        $ret = 'datetime';
                        break;
                    default:


                        if ('tinyint(1)' === $detailedType) {
                            $ret = 'switch';
                        } elseif (
                            $this->contains($column, 'photo') ||
                            $this->contains($column, 'image') ||
                            $this->contains($column, 'avatar')
                        ) {
                            $ret = 'upload';
                        } elseif ($this->contains($column, 'color')) {
                            $ret = 'color';
                        } elseif (
                            'pass' === $column ||
                            'password' === $column
                        ) {
                            $ret = 'pass';
                        } else {
                            $ret = 'input';
                        }
                        break;
                }
            }
        }
        if (false !== $ret) {
            $this->onTypeChosen($ret, $column, $table, $db, $type, $detailedType, $isAutoInc, $foreignKey, $isNullable);
        }
        return $ret;
    }


    protected function onTypeChosen(&$chosenType, $column, $table, $db, $type, $detailedType, $isAutoInc, $foreignKey, $isNullable)
    {

    }

    //--------------------------------------------
    //
    //--------------------------------------------
    private function contains($haystack, $needle)
    {
        return (false !== strpos($haystack, $needle));
    }

    private function check()
    {
        if (null === $this->dstDir) {
            throw new \Exception("dstDir not set");
        }
    }

}