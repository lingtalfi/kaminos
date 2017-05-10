<?php

namespace CrudGeneratorTools\Skinny\Generator;


use ArrayToString\ArrayToStringTool;
use Bat\FileSystemTool;
use QuickPdo\QuickPdoInfoTool;

class SkinnyTypeGenerator implements SkinnyTypeGeneratorInterface
{
    protected $dstDir;
    private $databases;

    public function __construct()
    {

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
            $fks = QuickPdoInfoTool::getForeignKeysInfo($table, $db);
            $nullables = QuickPdoInfoTool::getColumnNullabilities($db . "." . $table);
            $autoIncField = QuickPdoInfoTool::getAutoIncrementedField($db . '.' . $table);

            $column2SkinnyType = [];
            foreach ($types as $column => $type) {

                $isAutoInc = ($column === $autoIncField);
                $foreignKey = (array_key_exists($column, $fks)) ? $fks[$column] : null;
                $isNullable = $nullables[$column];

                if (false !== $skinnyType = ($this->getSkinnyType($column, $table, $db, $type, $isAutoInc, $foreignKey, $isNullable))) {
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


    protected function getSkinnyType($column, $table, $db, $type, $isAutoInc, $foreignKey, $isNullable)
    {
        if (true === $isAutoInc) {
            return 'auto_increment';
        } else {
            if (null !== $foreignKey) {
                return "selectForeignKey";
            } else {
                switch ($type) {
                    case 'text':
                        return 'textarea';
                        break;
                    case 'date':
                        return 'date';
                        break;
                    case 'datetime':
                        return 'datetime';
                        break;
                    default:
                        if (
                            $this->contains($column, 'photo') ||
                            $this->contains($column, 'image')
                        ) {
                            return 'upload';
                        }
                        return 'input';
                        break;
                }
            }
        }
        return false;
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