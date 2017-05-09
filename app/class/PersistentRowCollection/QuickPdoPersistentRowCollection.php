<?php


namespace PersistentRowCollection;


use PersistentRowCollection\Exception\PersistentRowCollectionException;
use QuickPdo\QuickPdo;

abstract class QuickPdoPersistentRowCollection implements InteractivePersistentRowCollectionInterface
{


    protected $table;


    public function __construct()
    {
        //
    }

    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    public function create(array $row)
    {
        if (false !== ($lastInsertId = QuickPdo::insert($this->table, $row))) {
            $ric = $this->getRic();
            $ret = [];
            if (null !== ($aic = $this->getAutoIncrementedColumn())) {
                $ret[$aic] = $lastInsertId;
            } else {
                foreach ($ric as $column) {
                    if (array_key_exists($column, $row)) {
                        $ret[$column] = $row[$column];
                    } else {
                        throw new PersistentRowCollectionException("The given row doesn't contain the column named $column");
                    }
                }
            }
            return $ret;
        }
        throw new PersistentRowCollectionException("Couldn't insert row");
    }


    protected function getAutoIncrementedColumn()
    {
        return null;
    }

}