<?php


namespace Kaminos\Module;


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Module\StepTrackerAwareModule;
use Kaminos\ModuleUtils\ModuleInstallTool;

abstract class KaminosModule extends StepTrackerAwareModule
{
    public function install()
    {

        $steps = [];
        $this->registerSteps($steps, 'install');
        $this->collectAutoSteps($steps, 'install');
        $this->getStepTracker()->setSteps($steps);


        $this->installAuto();
        $this->installModule();
    }

    public function uninstall()
    {
        // TODO: Implement uninstall() method.
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    protected function installModule()
    {

    }

    protected function uninstallModule()
    {

    }


    /**
     * @param $type , string (install|uninstall)
     */
    protected function registerSteps(array &$steps, $type)
    {

    }


    protected function collectAutoSteps(array &$steps, $type)
    {
        if (true === $this->usesAutoFiles()) {
            if ('install' === $type) {
                $steps['files'] = "Installing files";
            } else {
                $steps['files'] = "Uninstalling files";
            }
        }
    }

    protected function installAuto()
    {
        if (true === $this->usesAutoFiles()) {
            ModuleInstallTool::installFiles($this);
        }
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    private function usesAutoFiles()
    {
        $d = $this->getModuleDir();
        $f = $d . "/files/app";
        return (file_exists($f));
    }


    private function getModuleName()
    {
        $className = get_called_class();
        $p = explode('\\', $className);
        return $p[0];
    }

    private function getModuleDir()
    {
        $moduleName = $this->getModuleName();
        $appDir = ApplicationParameters::get("app_dir");
        return $appDir . "/class-modules/$moduleName";
    }


}