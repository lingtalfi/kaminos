<?php


namespace Module\Core\Pdo;


class QuickPdoQueryFormatter
{


    private $query;
    private $markers;


    public function __construct($query, array $markers = [])
    {
        $this->query = $query;
        $this->markers = $markers;
    }



    function __toString()
    {
        return "" . $this->query;
    }


}