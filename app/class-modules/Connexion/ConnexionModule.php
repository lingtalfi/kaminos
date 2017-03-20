<?php


namespace Connexion;


use Kamille\Module\StepTrackerAwareModule;

class ConnexionModule extends StepTrackerAwareModule
{


    public function install()
    {
        a("connexion module install");
        $this->stepTracker->startStep('files');
        $this->stepTracker->stopStep('files');
        $this->stepTracker->startStep('db');
        $this->stepTracker->stopStep('db');
    }

    public function uninstall()
    {
        a("connexion module uninstall");
    }

    protected function getStepsList()
    {
        return [
            'files' => "Installing files",
            'db' => "Installing tables in database",
        ];
    }


}


