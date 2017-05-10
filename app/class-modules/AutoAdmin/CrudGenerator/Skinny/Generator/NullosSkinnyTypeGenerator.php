<?php


namespace Module\AutoAdmin\CrudGenerator\Skinny\Generator;


use CrudGeneratorTools\Skinny\Generator\SkinnyTypeGenerator;
use Kamille\Ling\Z;

class NullosSkinnyTypeGenerator extends SkinnyTypeGenerator
{
    public function __construct()
    {
        parent::__construct();
        $this->setDstDir(Z::appDir() . "/store/AutoAdmin/skinny-types/auto");
    }


}