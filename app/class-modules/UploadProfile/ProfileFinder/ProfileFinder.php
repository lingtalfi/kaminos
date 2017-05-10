<?php


namespace Module\UploadProfile\ProfileFinder;

use Kamille\Services\XLog;


/**
 *
 * This finder is not really used (at least in my works), the FileProfileFinder is used instead.
 * But it remains here just in case.
 *
 *
 *
 * This finder assumes that files are organized in a certain way:
 *
 * the profileId has the following format:
 *
 * - profileId: Module.identifier
 *
 * And then the correspondence in the tree system is the following:
 *
 *
 * - /profileDir/Module.php
 *              This file contains a $profiles array which contains all the profile identifiers
 *              for this module, so the identifier is one of the key of the $profiles array.
 *
 *
 *
 *
 *
 */
class ProfileFinder implements ProfileFinderInterface
{

    private $profilesDir;


    public static function create()
    {
        return new static();
    }

    public function getProfile($profileId)
    {
        $p = explode('.', $profileId, 2);
        if (2 === count($p)) {
            list($module, $identifier) = $p;

            $f = $this->profilesDir . "/$module.php";
            if (file_exists($f)) {
                $profiles = [];
                include $f;
                if (array_key_exists($identifier, $profiles)) {
                    return $profiles[$identifier];
                } else {
                    XLog::error("ProfileFinder: profile identifier not found: $identifier, with profileId: $profileId");
                }
            } else {
                XLog::error("ProfileFinder: profile file not found: $f");
            }
        } else {
            XLog::error("ProfileFinder: invalid profileId format: $profileId, the format should be Module.identifier");
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