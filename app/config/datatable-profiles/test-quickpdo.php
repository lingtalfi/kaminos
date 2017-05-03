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
        'type' => 'quickPdo',
        'fields' => '
f.id as fournisseur_id,  
f.nom as fournisseur_nom,        
a.id as article_id,  
a.reference_lf as reference_lf,  
h.reference,      
h.prix        
        ',
        'query' => '
select %s from zilu.fournisseur_has_article h 
inner join zilu.fournisseur f on f.id=h.fournisseur_id        
inner join zilu.article a on a.id=h.article_id        
        ',
    ],
    'transformers' => [
        'action' => function ($oldValue, $columnId, array $row) {
            return [
                'type' => "link",
                'data' => [
                    'type' => 'modal',
                    'uri' => '/datatable-handler?type=special&id=test',
                    'confirm' => false,
                    'confirmText' => "Are you sure you want to execute this action?",
                    'icon' => "mail",
                    'label' => "Send a mail",
                ],
            ];
        }
    ],
    'model' => [
        'ric' => ['fournisseur_id', "article_id"],
        'headers' => [
            "fournisseur_nom" => "fournisseur",
            "reference_lf" => "référence lf",
            "reference" => "référence",
            "prix" => "prix",
        ],
        'hidden' => ['fournisseur_id', 'article_id'],
        'checkboxes' => true,
        'isSearchable' => true,
        'unsearchable' => ['action'],
        'isSortable' => true,
        'unsortable' => ['action'],
        'showCountInfo' => true,
        'showNipp' => true,
        'nippItems' => [20, 50, 100, 'all'],
        'showQuickPage' => true,
        'showPagination' => true,
        'paginationNavigators' => ['first', 'prev', 'next', 'last'],
        'paginationLength' => 9,
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
            'sendMail' => [
                'confirm' => false,
                'confirmText' => "Are you sure you want to execute this action?",
                'label' => "Send Mail",
                'useSelectedRows' => true,
                'uri' => "/datatable-handler?type=action",
                'type' => "refreshOnSuccess",
                'icon' => "mail",
            ],
        ],


        //--------------------------------------------
        // INITIAL SETTINGS
        // the user can override them
        //--------------------------------------------
        'page' => 1,
        'nipp' => 100,

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