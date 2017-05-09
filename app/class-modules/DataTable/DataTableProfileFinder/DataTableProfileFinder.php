<?php


namespace Module\DataTable\DataTableProfileFinder;

use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Ling\Z;
use Kamille\Services\XLog;


/**
 * This finder assumes that the profile is stored in a file, as an array referenced by
 * the variable name: profile ($profile).
 *
 */
class DataTableProfileFinder implements DataTableProfileFinderInterface
{

    private $profilesDir;
    private $fallbackHandlers;

    public function __construct()
    {
        $this->fallbackHandlers = [];
    }


    public static function create()
    {
        return new static();
    }

    public function getProfile($profileId)
    {
        $f = $this->profilesDir . "/$profileId.php";
        if (file_exists($f)) {
            if (true === ApplicationParameters::get("debug")) {
                XLog::debug("DataTableProfileFinder: profile file found: $f");
            }
            $profile = [];
            include $f;
            return $profile;
        } else {
            foreach ($this->fallbackHandlers as $fallbackHandler) {
                if (false !== ($file = call_user_func($fallbackHandler, $this->profilesDir, $profileId))) {
                    if (file_exists($file)) {
                        if (true === ApplicationParameters::get("debug")) {
                            XLog::debug("DataTableProfileFinder: fallback profile file found: $file");
                        }
                        $profile = [];
                        include $file;
                        return $profile;
                    }
                }
            }
            XLog::error("DataTableProfileFinder: profile not found with profileId $profileId");
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

    public function addFallbackHandler(callable $fallbackHandler)
    {
        $this->fallbackHandlers[] = $fallbackHandler;
        return $this;
    }


}