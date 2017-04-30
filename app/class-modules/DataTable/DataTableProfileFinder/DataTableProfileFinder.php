<?php


namespace Module\DataTable\DataTableProfileFinder;

use Kamille\Services\XLog;


/**
 * This finder assumes that the profile is stored in a file, as an array referenced by
 * the variable name: profile ($profile).
 *
 */
class DataTableProfileFinder implements DataTableProfileFinderInterface
{

    private $profilesDir;


    public static function create()
    {
        return new static();
    }

    public function getProfile($profileId)
    {
        $f = $this->profilesDir . "/$profileId.php";
        if (file_exists($f)) {
            $profile = [];
            include $f;
            return $profile;
        } else {
            XLog::error("DataTableProfileFinder: profile file not found: $f");
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