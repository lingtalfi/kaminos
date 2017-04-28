<?php


namespace Core\Module;


use Core\Services\A;
use Kamille\Module\KamilleModule;
use QuickPdo\QuickPdo;

class ApplicationModule extends KamilleModule
{


    protected function collectAutoSteps(array &$steps, $type)
    {
        parent::collectAutoSteps($steps, $type);

        if (true === $this->useDb()) {
            if ('install' === $type) {
                $steps['db'] = "Installing database assets";
            } else {
                $steps['db'] = "Uninstalling database assets";
            }
        }
    }


    protected function installAuto()
    {
        parent::installAuto();
        if (true === $this->useDb()) {
            $this->startStep('db');
            $this->output->notice(""); // just br
            $sqls = $this->getInstallDbScripts();
            if (is_array($sqls)) {
                A::quickPdoInit();
                foreach ($sqls as $identifier => $sql) {
                    $this->output->notice("Executing $identifier...");
                    QuickPdo::freeQuery($sql);
                }
            }
            $this->stopStep('db', "done");
        }
    }

    protected function uninstallAuto()
    {
        parent::uninstallAuto();
        if (true === $this->useDb()) {
            $this->startStep('db');
            $this->output->notice(""); // just br
            $sqls = $this->getUninstallDbScripts();
            if (is_array($sqls)) {
                A::quickPdoInit();
                foreach ($sqls as $identifier => $sql) {
                    $this->output->notice("Executing $identifier...");
                    QuickPdo::freeQuery($sql);
                }
            }
            $this->stopStep('db', "done");
        }
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Override this and return an array of identifier => sql
     * Each sql will get executed
     */
    protected function getInstallDbScripts()
    {
        return null;
    }

    /**
     * Override this and return an array of identifier => sql
     * Each sql will get executed
     */
    protected function getUninstallDbScripts()
    {
        return null;
    }
    //--------------------------------------------
    //
    //--------------------------------------------
    private function useDb()
    {
        return (null !== $this->getInstallDbScripts());
    }

}