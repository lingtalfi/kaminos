<?php


namespace ApplicationItemManager\Program;


use ApplicationItemManager\ApplicationItemManagerInterface;
use CommandLineInput\CommandLineInputInterface;
use Output\ProgramOutputInterface;
use Program\Program;
use Program\ProgramHelper;
use Program\ProgramInterface;

class ApplicationItemManagerProgram extends Program
{

    /**
     * @var ApplicationItemManagerInterface
     */
    private $manager;

    public function __construct()
    {
        parent::__construct();


        $itemType = $this->getItemType();

        $this
            ->addCommand("help", function (CommandLineInputInterface $input, ProgramOutputInterface $output, ProgramInterface $program) {
                $f = $this->getHelpPath();
                if (file_exists($f)) {
                    $s = file_get_contents($f);
                    $output->info($s);
                } else {
                    $output->error("Help file not found: $f");
                }
            })
            ->addCommand("import", function (CommandLineInputInterface $input, ProgramOutputInterface $output, ProgramInterface $program) use ($itemType) {
                $force = $input->getFlagValue('f');
                if (false !== ($itemName = ProgramHelper::getParameter(2, $itemType, $input, $output))) {
                    $this->manager->import($itemName, $force);
                }
            })
            ->addCommand("install", function (CommandLineInputInterface $input, ProgramOutputInterface $output, ProgramInterface $program) use ($itemType) {
                $force = $input->getFlagValue('f');
                if (false !== ($itemName = ProgramHelper::getParameter(2, $itemType, $input, $output))) {
                    $this->manager->install($itemName, $force);
                }
            });


    }

    public function setManager(ApplicationItemManagerInterface $manager)
    {
        $this->manager = $manager;
        return $this;
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function getHelpPath()
    {
        return __DIR__ . "/help.txt";
    }

    protected function getItemType()
    {
        return "item";
    }
}

