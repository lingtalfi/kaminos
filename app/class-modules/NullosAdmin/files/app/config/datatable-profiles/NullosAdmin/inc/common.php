<?php


use Core\Services\A;
use Kamille\Services\XConfig;

if (!isset($prc)) {
    throw new \Exception("Prc must exist");
}
$profile = [
    'rowsGenerator' => [
        'type' => 'prc',
        'id' => $prc,
    ],
    'transformers' => [
        'action' => function ($v, $columnId, array $row) use ($prc) {
            return [
                'type' => "dropdown",
                'data' => [
                    'text' => "Actions",
//                    'icon' => "fa fa-bullhorn",
                    'flavour' => "primary",
                    'size' => "xs",
                    'items' => [
                        [
                            'confirm' => false,
                            'label' => "Edit",
                            'id' => "edit",
                            'uri' => A::prcLink($prc, "form"),
                            'type' => "post",
                        ],
                        [
                            'confirm' => false,
                            'label' => "Delete",
                            'id' => "delete",
                            'uri' => "/crud-handler?prc=NullosAdmin.User",
                            'type' => "refreshOnSuccess",
                        ],
                    ],
                ],
            ];
        },
    ],
    'model' => [
        'headers' => "OVERRIDE",
        'ric' => "OVERRIDE",
        'hidden' => "OVERRIDE",
        //
        'checkboxes' => true,
        'isSearchable' => true,
        'unsearchable' => ['action'],
        'isSortable' => true,
        'unsortable' => ['action'],
        'showCountInfo' => true,
        'showNipp' => false,
        'nippItems' => [20, 50, 100, 'all'],
        'showQuickPage' => false,
        'showPagination' => true,
        'paginationNavigators' => ['first', 'prev', 'next', 'last'],
        'paginationLength' => 5,
        'showBulkActions' => true,
        'showEmptyBulkWarning' => true,
        'bulkActions' => [
            'deleteAll' => [
                'confirm' => false,
                'confirmText' => "Are you sure you want to execute this action?",
                'label' => "Delete items",
                'uri' => "/datatable-handler?type=bulk",
                'type' => "modal",
            ],
        ],
        'showActionButtons' => true,
        'actionButtons' => [
            'addItem' => [
                'confirm' => false,
                'confirmText' => "Are you sure you want to execute this action?",
                'label' => "OVERRIDE",
                'useSelectedRows' => false,
                'uri' => XConfig::get("NullosAdmin.uriCrud") . "?type=form&prc=" . $prc,
                'type' => "link",
                'icon' => "fa fa-plus",
            ],
        ],


        //--------------------------------------------
        // INITIAL SETTINGS
        // the user can override them
        //--------------------------------------------
        'page' => 1,
        'nipp' => 20,

        //--------------------------------------------
        // TEXT
        //--------------------------------------------
        'textNoResult' => 'No results found',
        'textSearch' => 'Search',
        'textSearchClear' => 'Clear',
        'textCountInfo' => 'Showing {offsetStart} to {offsetEnd} of {nbItems} entries',
        'textNipp' => 'Show {select} entries',
        'textNippAll' => 'all',
        'textQuickPage' => 'Page',
        'textQuickPageButton' => 'Go',
        'textBulkActionsTeaser' => 'For selected entries',
        'textEmptyBulkWarning' => 'Please select at least one row',
        'textUseSelectedRowsEmptyWarning' => 'Please select at least one row',
        'textPaginationFirst' => 'First',
        'textPaginationPrev' => 'Prev',
        'textPaginationNext' => 'Next',
        'textPaginationLast' => 'Last',
    ],
];