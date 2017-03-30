<?php


namespace CommandLineInput;

/**
 * This concrete class implements the standard notation described in the implemented interface.
 *
 */
class CommandLineInput implements CommandLineInputInterface
{

    private $shortOptions;
    private $longOptions;
    private $parameters;


    public function __construct()
    {
        $this->shortOptions = [];
        $this->longOptions = [];
        $this->parameters = [];
    }


    public function getOptionValue($optionName, $default = null)
    {
    }

    public function getParameter($index, $default = null)
    {

    }
}