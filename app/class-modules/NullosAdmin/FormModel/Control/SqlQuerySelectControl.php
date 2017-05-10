<?php


namespace Module\NullosAdmin\FormModel\Control;


use FormModel\Control\SelectControl;
use QuickPdo\QuickPdo;

class SqlQuerySelectControl extends SelectControl
{

    private $_firstOption;
    private $_query;

    public function firstOption($label, $value = 0)
    {
        $this->_firstOption = [$label, $value];
        return $this;
    }

    public function query($query)
    {
        $this->_query = $query;
        return $this;
    }

    protected function prepareArray(array &$array)
    {

        $items = QuickPdo::fetchAll($this->_query, [], \PDO::FETCH_COLUMN | \PDO::FETCH_UNIQUE);
        if (null !== $this->_firstOption) {
            list($label, $value) = $this->_firstOption;
            if (null === $value) {
                // todo?
            }
            // else assume value is 0
            array_unshift($items, $label);
        }
        $this->setItems($items);
        parent::prepareArray($array);
    }
}