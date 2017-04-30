<?php


/**
 * This is a datatable profile.
 * It contains the information necessary to display a datatable aware
 * of user parameters.
 *
 *
 *
 */

$profile = [
    'rowsGenerator' => [
        'type' => 'array',
        'path' => '/myphp/kaminos/app/www/twitter.rows.php',
    ],
    'model' => [
        'headers' => [
            "firstName" => "first Name",
            "lastName" => "last Name",
            "userName" => "user Name",
            "action" => "Action",
        ],
        'hidden' => ['lastName'],
        'ric' => ['firstName'],
        'checkboxes' => true,
        'isSearchable' => true,
        'unsearchable' => ['action'],
        'isSortable' => true,
        'unsortable' => ['action'],
        'showCountInfo' => true,
        'showNipp' => true,
        'showQuickPage' => true,
        'showPagination' => true,
        'showBulkActions' => true,
        'bulkActions' => [
            'deleteAll' => [
                'confirm' => false,
                'confirmText' => "Are you sure you want to execute this action?",
                'label' => "Delete items",
                'uri' => "/datatable-myactions?actiondelete-all",
                'type' => "refreshOnSuccess",
            ],
        ],
        'showActionButtons' => true,
        'actionButtons' => [
            'sendMail' => [
                'confirm' => false,
                'confirmText' => "Are you sure you want to execute this action?",
                'label' => "Send Mail",
                'uri' => "/datatable-myactions?sendmail",
                'type' => "modal",
                'icon' => "mail",
            ],
        ],


        //--------------------------------------------
        // INITIAL SETTINGS
        // the user can override them
        //--------------------------------------------
        'page' => 1,
        'nipp' => 2,

        //--------------------------------------------
        // TEXT
        //--------------------------------------------
        'textNoResult' => 'No results found',
        'textSearch' => 'Search',
        'textCountInfo' => 'Showing {offsetStart} to {offsetEnd} of {nbItems} entries',
        'textNipp' => 'Show {select} entries',
        'textNippAll' => 'all',
        'textQuickPage' => 'Page',
        'textQuickPageButton' => 'Go',
        'textBulkActionsTeaser' => 'For selected entries',
    ],
];