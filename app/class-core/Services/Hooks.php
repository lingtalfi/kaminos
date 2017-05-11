<?php


namespace Core\Services;


use Kamille\Services\AbstractHooks;


/**
 * This class is used to hook modules dynamically.
 * This class is written by modules, so, be careful I guess.
 *
 * A hook is always a public static method (in this class)
 *
 *
 * Rules of thumb: you can add new methods, but NEVER REMOVE A METHOD
 * (because you might break a dependency that someone made to this method)
 */
class Hooks extends AbstractHooks
{

//    public static function StaticPageRouter_feedUri2Page(array &$uri2Page)
//    {
//        \Toast\ToastHooks::StaticPageRouter_feedUri2Page($uri2Page);
//        AppRouter::StaticPageRouter_feedUri2Page($uri2Page);
//    }
//
//    public static function StaticObjectRouter_feedUri2Controller(array &$uri2Controller)


//    {
//        AppRouter::StaticObjectRouter_feedUri2Controller($uri2Controller);
//    }


    protected static function Test_feedUri2Controller(array &$uri2Controller)
    {
        $uri2Controller["/login"] = "something";
    }


    protected static function Core_addLoggerListener(\Logger\LoggerInterface $logger)
    {
        if (true === \Kamille\Services\XConfig::get("Core.useFileLoggerListener")) {
            $f = \Kamille\Services\XConfig::get("Core.logFile");
            $logger->addListener(\Logger\Listener\FileLoggerListener::create()
                ->setFormatter(\Logger\Formatter\TagFormatter::create())
                ->setIdentifiers(null)
                ->setPath($f));
        }


        if (true === \Kamille\Services\XConfig::get("Core.useDbLoggerListener")) {

            $f = \Kamille\Services\XConfig::get("Core.dbLogFile");
            $logger->addListener(\Logger\Listener\FileLoggerListener::create()
                ->setFormatter(\Logger\Formatter\TagFormatter::create())
                ->setIdentifiers(null)
                ->setPath($f));
        }
    }

    protected static function Core_feedEarlyRouter(\Module\Core\Architecture\Router\EarlyRouter $router)
    {
        // mit-start:Authenticate
        $router->addRouter(\Module\Authenticate\Architecture\Router\AuthenticateRouter::create());
        // mit-end:Authenticate
    }

    protected static function Core_autoLawsConfig(&$data)
    {


        // mit-start:NullosAdmin
        $autoJsScript = "/theme/" . \Kamille\Architecture\ApplicationParameters\ApplicationParameters::get("theme") . "/controllers/" . \Bat\ClassTool::getShortName($data[0]) . ".js";
        $file = \Kamille\Architecture\ApplicationParameters\ApplicationParameters::get("app_dir") . "/www" . $autoJsScript;
        if (file_exists($file)) {
            $data[1]['layout']['conf']["jsScripts"][] = $autoJsScript;
        }
        // mit-end:NullosAdmin
    }

    protected static function Core_feedAjaxUri2Controllers(array &$uri2Controllers)
    {
        // mit-start:UploadProfile
        $uri2Controllers[\Kamille\Services\XConfig::get("UploadProfile.uploadUri")] = "Controller\UploadProfile\UploadController:handleUpload";
        // mit-end:UploadProfile
    }

    protected static function Core_addLawsUtilProxyDecorators(\Kamille\Mvc\LayoutProxy\LawsLayoutProxyInterface $layoutProxy)
    {
        if ($layoutProxy instanceof \Kamille\Mvc\LayoutProxy\LawsLayoutProxy) {
            $layoutProxy->addDecorator(\Kamille\Mvc\WidgetDecorator\PositionWidgetDecorator::create());
        }

        // mit-start:NullosAdmin
        if ($layoutProxy instanceof \Kamille\Mvc\LayoutProxy\LawsLayoutProxy) {
            $layoutProxy->addDecorator(\Kamille\Mvc\WidgetDecorator\Bootstrap3GridWidgetDecorator::create());
        }
        // mit-end:NullosAdmin
    }

    protected static function Core_lazyJsInit_addCodeWrapper(\Module\Core\JsLazyCodeCollector\JsLazyCodeCollectorInterface $collector)
    {


        // mit-start:NullosAdmin
        $collector->addCodeWrapper('jquery', function ($s) {
            $r = '$(document).ready(function () {' . PHP_EOL;
            $r .= $s;
            $r .= '});' . PHP_EOL;
            return $r;
        });
        // mit-end:NullosAdmin
    }

    protected static function Core_ModalGscpResponseDefaultButtons(array &$buttons)
    {


        // mit-start:NullosAdmin
        $buttons = [
            "close" => [
                "flavour" => "default",
                "label" => "Close",
                "htmlAttr" => [
                    "data-dismiss" => "modal",
                ],
            ],
        ];
        // mit-end:NullosAdmin
    }

    protected static function NullosAdmin_layout_addTopBarRightWidgets(array &$topbarRightWidgets)
    {
        // mit-start:Ekom
        $prefixUri = "/theme/" . \Kamille\Architecture\ApplicationParameters\ApplicationParameters::get("theme");
        $imgPrefix = $prefixUri . "/production";

        unset($topbarRightWidgets['topbar_right.userMessages']);

        $topbarRightWidgets["topbar_right.shopListDropDown"] = [
            "tpl" => "Ekom/ShopListDropDown/prototype",
            "conf" => [
                'nbMessages' => 10,
                'badgeColor' => 'red',
                'showAllMessagesLink' => true,
                'allMessagesText' => "See All Alerts",
                'allMessagesLink' => "/user-alerts",
                "messages" => [
                    [
                        "link" => "/ji",
                        "title" => "John Smith",
                        "image" => $imgPrefix . '/images/ling.jpg',
                        "aux" => "3 mins ago",
                        "message" => "Film festivals used to be do-or-die moments for movie makers. They were where...",
                    ],
                    [
                        "link" => "/ji",
                        "title" => "John Smith",
                        "image" => $imgPrefix . '/images/img.jpg',
                        "aux" => "12 mins ago",
                        "message" => "Film festivals used to be do-or-die moments for movie makers. They were where...",
                    ],
                ],
            ],
        ];
        // mit-end:Ekom
    }

    protected static function NullosAdmin_layout_sideBarMenuModel(array &$sideBarMenuModel)
    {
        // mit-start:Ekom
        $sideBarMenuModel['sections'][] = [
            "label" => "Ekom",
            "items" => [
                [
                    "icon" => "fa fa-home",
                    "label" => "test",
                    'badge' => [
                        'type' => "success",
                        'text' => "success",
                    ],
                    "items" => [
                        [
                            "icon" => "fa fa-but",
                            "label" => "bug",
                            "link" => "/pou",
                            "items" => null,
                        ],
                    ],
                ],
            ],
        ];
        // mit-end:Ekom

        // mit-start:AutoAdmin
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
        // mit-end:AutoAdmin
    }

    protected static function DataTable_getRendererClassName(&$renderer)
    {
        // mit-start:NullosAdmin
        $renderer = 'Module\NullosAdmin\ModelRenderers\DataTable\NullosDataTableRenderer';
        // mit-end:NullosAdmin
    }

    protected static function DataTable_configureProfileFinder(\Module\DataTable\DataTableProfileFinder\DataTableProfileFinder $profileFinder)
    {
        // mit-start:AutoAdmin
        $profileFinder->addFallbackHandler(function ($dir, $profileId) {
            $p = explode('/', $profileId);
            if (3 === count($p)) {
                $manual = implode('/', [$p[0], 'manual', $p[1], $p[2]]);
                $f = $dir . "/$manual.php";
                if (file_exists($f)) {
                    return $f;
                }
            }
            return false;
        });
        // mit-end:AutoAdmin
    }


}

