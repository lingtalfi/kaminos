<?php


namespace Connexion;


use Kamille\Module\Exception\ModuleException;
use Kamille\Module\ModuleInterface;
use Kamille\Utils\StepTracker\StepTrackerAwareInterface;
use Kamille\Utils\StepTracker\StepTrackerInterface;

class ConnexionModule implements ModuleInterface, StepTrackerAwareInterface
{

    /**
     * @var StepTrackerInterface $stepTracker
     */
    private $stepTracker;

    public function install()
    {
        a("connexion module install");


        $this->stepTracker->startStep("connexion module install");
        $this->stepTracker->startStep("connexion module install");
    }

    public function uninstall()
    {
        a("connexion module uninstall");
    }

    public function setStepTracker(StepTrackerInterface $stepTracker)
    {
        $this->stepTracker=$stepTracker;
    }


}


