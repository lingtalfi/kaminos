<?php


namespace Authenticate\ProfileStore;


use Authenticate\Profile\ProfileInterface;

interface ProfileStoreInterface
{

    /**
     * @return ProfileInterface
     */
    public function getProfile($name);

    /**
     * @return ProfileInterface[]
     */
    public function getProfiles();

    /**
     * commit changes to disk
     */
    public function store();

    /**
     * @return array, list of profile name => badges
     */
    public function retrieve();
}