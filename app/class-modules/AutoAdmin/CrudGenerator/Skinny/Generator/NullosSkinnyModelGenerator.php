<?php


namespace Module\AutoAdmin\CrudGenerator\Skinny\Generator;


use CrudGeneratorTools\Skinny\Generator\SkinnyModelGenerator;
use Kamille\Ling\Z;

class NullosSkinnyModelGenerator extends SkinnyModelGenerator
{
    public function __construct()
    {
        parent::__construct();
        $this->setDstDir(Z::appDir() . "/store/AutoAdmin/skinny-types/auto");
    }
}