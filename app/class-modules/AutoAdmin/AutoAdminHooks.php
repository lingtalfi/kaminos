<?php


namespace Module\AutoAdmin;


class AutoAdminHooks
{
    protected static function NullosAdmin_layout_sideBarMenuModel(array &$sideBarMenuModel)
    {
        $items = [];
        $f = \Module\AutoAdmin\AutoAdminHelper::getGeneratedSideBarMenuPath();
        if (file_exists($f)) {
            include $f;
        }
        $sideBarMenuModel['sections'][] = [
            "label" => "AutoAdmin",
            "items" => $items,
        ];
    }

    protected static function DataTable_configureProfileFinder(\Module\DataTable\DataTableProfileFinder\DataTableProfileFinder $profileFinder)
    {
        $profileFinder->addFallbackHandler(function ($dir, $profileId) {
            $p = explode('/', $profileId);
            if (2 === count($p)) {
                $manual = implode('/', [$p[0], 'manual', $p[1]]);
                $f = $dir . "/$manual.php";
                if (file_exists($f)) {
                    return $f;
                }
            }
            return false;
        });
    }
}


