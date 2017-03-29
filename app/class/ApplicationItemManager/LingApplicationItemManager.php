<?php


namespace ApplicationItemManager;


use ApplicationItemManager\Importer\ImporterInterface;
use ApplicationItemManager\Installer\InstallerInterface;
use ApplicationItemManager\ItemList\ItemListInterface;
use Output\ProgramOutputAwareInterface;
use Output\ProgramOutputInterface;

class LingApplicationItemManager extends ApplicationItemManager
{
    protected $output;

    public function setOutput(ProgramOutputInterface $output)
    {
        $this->output = $output;
        return $this;
    }

    public function bindImporter($importerId, ImporterInterface $importer)
    {
        if ($importer instanceof ProgramOutputAwareInterface) {
            $importer->setProgramOutput($this->output);
        }
        return parent::bindImporter($importerId, $importer);
    }

    public function setInstaller(InstallerInterface $installer)
    {
        if ($installer instanceof ProgramOutputAwareInterface) {
            $installer->setProgramOutput($this->output);
        }
        return parent::setInstaller($installer);
    }


}