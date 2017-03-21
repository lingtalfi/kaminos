<?php


namespace GentelellaWebDirectory;


use Bat\FileSystemTool;
use CopyDir\AuthorCopyDirUtil;
use Kamille\Module\StepTrackerAwareModule;

class GentelellaWebDirectoryModule extends StepTrackerAwareModule
{


    public function install()
    {
        $o = AuthorCopyDirUtil::create();
        $ret = $o->copyDir($src, $target);
        $errors = $o->getErrors();
        return $ret;


        a("GentelellaWebDirectory module install");
        $this->stepTracker->startStep('files');
        $this->stepTracker->stopStep('files');
        $this->stepTracker->startStep('db');
        $this->stepTracker->stopStep('db');
    }

    public function uninstall()
    {
        a("GentelellaWebDirectory module uninstall");
    }

    protected function getStepsList()
    {
        return [
            'files' => "Installing files",
            'db' => "Installing tables in database",
        ];
    }


}


