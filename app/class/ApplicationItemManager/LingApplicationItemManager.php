<?php


namespace ApplicationItemManager;


use Output\ProgramOutputInterface;

class LingApplicationItemManager extends ApplicationItemManager
{
    protected $output;

    public function setOutput(ProgramOutputInterface $output)
    {
        $this->output = $output;
        return $this;
    }

    protected function write($msg, $type)
    {
        echo $this->output->$type($msg);
    }
}