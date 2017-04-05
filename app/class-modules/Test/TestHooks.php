<?php


namespace Module\Test;


class TestHooks
{

    protected static function Core_feedUri2Controller(array &$uri2Controller)
    {
        $uri2Controller["/test"] = 'Controller\Test\TestController:render';
        $uri2Controller["/blaster"] = "something";
    }


    protected static function Test_feedUri2Controller(array &$uri2Controller)
    {
        $uri2Controller["/login"] = "something";
    }
}


