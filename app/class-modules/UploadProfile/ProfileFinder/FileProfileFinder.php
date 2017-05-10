<?php


namespace Module\UploadProfile\ProfileFinder;

use Bat\UriTool;
use Kamille\Services\XLog;


/**
 * This finder assumes that files are organized in a certain way:
 *
 * the profileId has the following format:
 *
 * - profileId: Module/identifier
 *
 * And then the correspondence in the tree system is the following:
 *
 *
 * - /profileDir/identifier.php
 *
 *              This file contains the $profiles array.
 *
 * By convention, the identifier starts with "$Module/", and thus serves as a namespace for the different modules.
 *
 */
class FileProfileFinder implements ProfileFinderInterface
{

    private $profilesDir;


    public static function create()
    {
        return new static();
    }

    public function getProfile($profileId)
    {
        $profileId = UriTool::noEscalating($profileId);

        $f = $this->profilesDir . "/$profileId.php";

        if (file_exists($f)) {
            $profile = [];
            include $f;
            return $profile;
        } else {


            $p = explode('/', $profileId);
            $last = array_pop($p);
            $f = $this->profilesDir . '/' .  implode('/', $p) . '/auto/' . $last . '.php';

            if (file_exists($f)) {
                $profile = [];
                include $f;
                return $profile;
            } else {
                XLog::error("ProfileFinder: profile file not found: $f");
            }
        }
        return false;
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    public function setProfilesDir($profilesDir)
    {
        $this->profilesDir = $profilesDir;
        return $this;
    }


}