<?php


namespace Authenticate\Profile;

use Authenticate\BadgeGroup\BadgeGroupInterface;

interface ProfileInterface
{

    /**
     * @return false|BadgeGroupInterface
     */
    public function getBadgeGroup($name);

    /**
     * @return BadgeGroupInterface[]
     */
    public function getBadgeGroups();
}