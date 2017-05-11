<?php


namespace Module\AutoAdmin\CrudGenerator\Util;


use CrudGeneratorTools\Util\ForeignKeyPreferredColumnUtil;
use Kamille\Ling\Z;

class NullosForeignKeyPreferredColumnUtil extends ForeignKeyPreferredColumnUtil
{
    public function __construct()
    {
        parent::__construct();
        $this->setCacheDir(Z::appDir() . "/store/AutoAdmin/foreignKeyPreferredColumns");
    }


}