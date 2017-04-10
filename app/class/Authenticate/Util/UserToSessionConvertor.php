<?php


namespace Authenticate\Util;


use Authenticate\User\UserInterface;

class UserToSessionConvertor
{

    public static function toSession(UserInterface $user, array $filter = null)
    {
        $ret = [];
        foreach ($user as $k => $v) {
            if (null === $filter || !in_array($k, $filter, true)) {
                $ret[$k] = $v;
            }
        }
        return $ret;
    }

}