<?php


namespace Module\UploadProfiles\ProfileCollection;


class ProfileCollection implements ProfileCollectionInterface
{

    private $profiles;


    public function __construct()
    {
        $this->profiles = [];
    }


    public static function create()
    {
        return new static();
    }

    public function getProfiles()
    {
        return $this->profiles;
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    public function setProfiles(array $profiles)
    {
        $this->profiles = $profiles;
        return $this;
    }


}