<?php


namespace Module\NullosAdmin;


class NullosAdminServices
{

    protected static function NullosAdmin_themeHelper()
    {
        return \Module\NullosAdmin\ThemeHelper\ThemeHelper::create();
    }
}


