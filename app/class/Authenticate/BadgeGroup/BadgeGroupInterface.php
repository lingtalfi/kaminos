<?php


namespace Authenticate\BadgeGroup;

interface BadgeGroupInterface
{

    /**
     * @return array of badges (a badge is a string)
     */
    public function getBadges();
}