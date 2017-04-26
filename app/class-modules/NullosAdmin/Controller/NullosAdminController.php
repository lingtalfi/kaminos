<?php


namespace Controller\NullosAdmin;


use Bat\ClassTool;
use Core\Controller\ApplicationController;
use Core\Services\Hooks;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;


class NullosAdminController extends ApplicationController
{


    public function renderPage()
    {


    }



    //--------------------------------------------
    //
    //--------------------------------------------
    protected function renderMainContent()
    {

    }


    protected function renderByViewId($viewId, $config = null, array $options = [])
    {


        $prefixUri = "/theme/" . ApplicationParameters::get("theme");
        $imgPrefix = $prefixUri . "/production";


        if (null === $config) {
            $config = [];
        }


        $widgets = [
            "sidebar.navTitle" => [
                "tpl" => "NullosAdmin/NavTitle/default",
                "conf" => [
                    "link" => "index.html",
                    "iconClass" => "fa fa-paw",
                    "title" => "NullosAdmin",
                ],
            ],
            "sidebar.menuProfileQuickInfo" => [
                "tpl" => "NullosAdmin/MenuProfileQuickInfo/default",
                "conf" => [
                    "imgSrc" => $imgPrefix . '/images/ling.jpg',
                    "imgAlt" => "...",
                    "welcomeText" => "Welcome,",
                    "userName" => "John Doe",
                ],
            ],
            "sidebar.sidebarMenu" => [
                "tpl" => "NullosAdmin/SidebarMenu/default",
                "conf" => [
                    "sidebarMenuModel" => [
                        "sections" => [
                            [
                                "label" => "pou",
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
                            ],
                        ],
                    ],
                ],
            ],
            "sidebar.menuFooterButtons" => [
                "tpl" => "NullosAdmin/MenuFooterButtons/default",
                "conf" => [
                    'buttons' => [
                        [
                            "title" => 'Settings',
                            "icon" => 'glyphicon glyphicon-cog',
                        ],
                        [
                            "title" => 'FullScreen',
                            "icon" => 'glyphicon glyphicon-fullscreen',
                        ],
                        [
                            "title" => 'Lock',
                            "icon" => 'glyphicon glyphicon-eye-close',
                        ],
                        [
                            "title" => 'Logout',
                            "link" => '/logout',
                            "icon" => 'glyphicon glyphicon-off',
                        ],
                    ],
                ],
            ],
            "topbar_left.menuToggle" => [
                "tpl" => "NullosAdmin/MenuToggle/default",
                "conf" => [],
            ],

        ];

        $topbarRightWidgets = [
            "topbar_right.userMenuDropdown" => [
                "tpl" => "NullosAdmin/UserMenuDropdown/default",
                "conf" => [
                    "userImgSrc" => $imgPrefix . '/images/ling.jpg',
                    "userName" => "John Doe",
                    "items" => [
                        [
                            'text' => "Profile",
                        ],
                        [
                            'text' => "Settings",
                            'badge' => [
                                'color' => "red",
                                'text' => "50%",
                            ],
                        ],
                        [
                            'text' => "Help",
                        ],
                        [
                            'text' => "Log out",
                            'icon' => "fa fa-sign-out",
                            'link' => "/logout",
                        ],
                    ],
                ],
            ],
            "topbar_right.userMessages" => [
                "tpl" => "NullosAdmin/UserMessages/default",
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
            ],
        ];
        Hooks::call("NullosAdmin_layout_addTopBarRightWidgets", $topbarRightWidgets);
        $widgets = array_merge($widgets, $topbarRightWidgets);

        $config = array_replace_recursive([
            "layout" => [
                "tpl" => "admin/default",
            ],
            "widgets" => $widgets
        ], $config);

        return parent::renderByViewId($viewId, $config, $options);
    }


}