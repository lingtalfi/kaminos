<?php


namespace Module\AutoAdmin;


class AutoAdminHooks
{
    protected static function NullosAdmin_layout_sideBarMenuModel(array &$sideBarMenuModel)
    {
        $sideBarMenuModel['sections'][] = [
            "label" => "AutoAdmin",
            "items" => [
                [
                    "icon" => "fa fa-database",
                    "label" => "zilu",
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
    }
}


