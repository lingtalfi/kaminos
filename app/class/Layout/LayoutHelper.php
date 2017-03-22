<?php


namespace Layout;


use Kamille\Architecture\Application\Web\WebApplication;

class LayoutHelper
{
    public static function getRootUrl(){
        return "/" . WebApplication::inst()->get('theme');
    }
}