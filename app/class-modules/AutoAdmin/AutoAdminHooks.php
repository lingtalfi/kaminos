<?php


namespace Module\AutoAdmin;


class AutoAdminHooks
{
    protected static function NullosAdmin_layout_sideBarMenuModel(array &$sideBarMenuModel)
    {
        $allItems = [];
        $dir = \Module\AutoAdmin\AutoAdminHelper::getGeneratedSideBarMenuPath();
        $autoDir = $dir . "/auto";
        $manualDir = $dir . "/manual";
        if (is_dir($autoDir)) {
            $dbFiles = \DirScanner\YorgDirScannerTool::getFilesWithExtension($autoDir, 'php', false, false, true);
            foreach ($dbFiles as $dbFile) {
                $items = [];
                $manualFile = $manualDir . "/$dbFile";
                if (file_exists($manualFile)) {
                    include $manualFile;
                }
                else{
                    include $autoDir . "/$dbFile";
                }
                $allItems[] = $items;
            }

            $sideBarMenuModel['sections'][] = [
                "label" => "AutoAdmin",
                "items" => $allItems,
            ];
        }
    }

    protected static function DataTable_configureProfileFinder(\Module\DataTable\DataTableProfileFinder\DataTableProfileFinder $profileFinder)
    {
        $profileFinder->addFallbackHandler(function ($dir, $profileId) {
            $p = explode('/', $profileId);
            if (3 === count($p)) {
                $manual = implode('/', [$p[0], 'manual', $p[1], $p[2]]);
                $f = $dir . "/$manual.php";
                if (file_exists($f)) {
                    return $f;
                } else {
                    $auto = implode('/', [$p[0], 'auto', $p[1], $p[2]]);
                    $f = $dir . "/$auto.php";
                    if (file_exists($f)) {
                        return $f;
                    }
                }
            }
            return false;
        });
    }
}


