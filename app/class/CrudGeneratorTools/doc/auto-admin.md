Auto-Admin
===============
2017-05-02


It's all about lists and forms,
or to be more precise: how do you generate the lists and forms for a given set of tables.


One of the greatest problem we will have to tackle is that both lists and forms need to react to the relationship between tables.

For instance, imagine the following schema with two tables, where an user owns a car.


```txt
- table user
----- id
----- name
----- pass

- table car
----- id
----- user_id: (foreign key)
----- model
----- price
```


Given that structure, one thing that we would like is the option to choose between those 
two representations of a car list:


representation with the user_id as user_id:
-------------------------

```txt
id      user_id     model               price
1       1           volkswagen          10
2       1           fiat                100
3       2           chrysler            100
```


representation with the user.name as user_id:
-------------------------

```txt
id      user_id     model               price
1       paul        volkswagen          10
2       paul        fiat                100
3       emilie      chrysler            100
```


Actually, it might make even more sense if we could also change the column names, like in the following example:


representation with the user.name as user_id:
-------------------------

```txt
id      user_name     model               price
1       paul        volkswagen          10
2       paul        fiat                100
3       emilie      chrysler            100
```


That should give you an idea of the problem with list.


Now for forms, imagine that we want to generate a form for inserting a car in the database,
then we have a similar problem, as exposed below:


representation with the user_id as user_id:
-------------------------

```txt
model: input
price: input
user_id: select
            - 1
            - 2
            - 3
```

representation with the user_name as user_id:
-------------------------

```txt
model: input
price: input
user_id: select
            - paul
            - emilie
            - johan
```


representation with the user_name as user_id, and the column name user_id changed to user_name
-------------------------

```txt
model: input
price: input
user_name: select
            - paul
            - emilie
            - johan
```


So, now you should have an understanding of the biggest problem we need to resolve.

So now we will go into the details of what kind of tools we want to provide in order to help an auto-admin implementor 
do her job.
 
 
 
 
First, we will get started by making the assumption that the implementor will need to generate files, one per table and one per type.
So for instance, she will need to generate a structure like this for instance (file names and dir names might change):
 
```txt
- auto-generated-list/
----- db1.table1.php
----- db1.table2.php
----- ...
- auto-generated-form/
----- db1.table1.php
----- db1.table2.php
----- ...
``` 

So, we already know that we will need to iterate over the database(s) tables.
 
Also, we don't know what's inside the table1.php files (that's because there are as many possible implementations as 
there are implementors), so we won't be able to generate the concrete content of those files, but only provide tools 
that will help generate that content.

So our strategy will be to estimate the kind of things those files need, and provide relevant tools to help with the job
of providing those things.


To make things simple, we will make one tool for helping with lists, and another for helping with forms,
and both will extend a common CrudGeneratorHelper class.

 
```txt
- CrudGeneratorHelper
----- ListCrudGeneratorHelper
----- FormCrudGeneratorHelper
``` 

This allows us to have the iteration method at the CrudGeneratorHelper level, thus available to both list and form generators.

- setDatabases( array databases)
- getTables(db=null, useDbPrefix=true)
    - if the db is not specified, this method will iterate over every database provided with the setDatabases method


 
 
 
Lists
==============


Here is an example of DataTable configuration using a quickpdo generator (taken from a datatable profile file from the NullosAdmin module of the kamille framework).


```php
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
```
 


From there, we will focus for now only on the rowsGenerator section, which is part of what we want to generate
(later, we will need to generate the transformers section as well):


```php
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
```

So, this starts to be concrete: we need to be able to generate a standard view of the table.
In particular (in this example), we need to generate two things:

- the fields
- the query

That's a good example though because this system is used in other auto-admins I've seen.


If we merge those fields together, we obtain the original sql query that we want to generate.

```txt
select 

f.id as fournisseur_id,  
f.nom as fournisseur_nom,        
a.id as article_id,  
a.reference_lf as reference_lf,  
h.reference,      
h.prix
 
from zilu.fournisseur_has_article h 
inner join zilu.fournisseur f on f.id=h.fournisseur_id        
inner join zilu.article a on a.id=h.article_id  
```


That's a fairly common example of list that we need to generate.

But let's start even simpler with a simple table with no relationship, just to get started.

```txt
select 
id,  
nom,
email
from fournisseur  
```



All we need here is to grab all the fields of a table. 
So we can add the following method to our Helper:

- array     getColumnNames( table )
        returns the names of the columns of the given table



Ok, let's move on to a next example.

I like to think with a model in front of me, so I will provide the zilu-schema.pdf document,
and will assume you've opened it so you can follow along with me.

By the way, this is a database schema used for an old project (but who cares).


Foreign key
===================
Ignoring the right half of the schema, focusing on the container table.


This is a simple table with only one foreign key.

So, the main table: 

- container
    - id
    - nom
    - type_container_id: fk


As we've discussed before, we don't want to simply display the flat type_container_id here, but rather a more
human readable column.

But what are our options here?

If we look into the foreign table: type_container, we have the following columns:

- type_container
    - id
    - label
    - poids_max
    - volume_max

So, the question is: should we take the value of the id, label, poids_max or volume_max column?

We will agree that in the end, this is a human choice; although that could be in some degrees automated (for instance
every column named label would be a candidate for being the selected field).

This first question leads us to a first term: foreignKeyPreferredColumn.


foreignKeyPreferredColumn
--------------------------
If column A from table T is a foreign key to column B from table T2,  
then the foreignKeyPreferredColumn is the column from T2 that we use instead of A (in order to make
the rendered list more human friendly).

Implementation wise, we won't bother trying to automate those preferences, and will let that to the user,
since creating the preferences will be done only once per schema (so it doesn't cost much, even for lazy
people like me).

So, we will have one foreignKeyPreferredColumn for every table that is referenced at least once by another table.
  
And actually, we can automate the creation of the array with non-accurate values (taking the first non auto-incremented 
column every time, just for the sake of having a name), as an array to complete by the user.


Here is a concrete implementation from my previous auto-admin generator (in nullos admin),
just as an example:

```php
<?php


namespace Crud\Util;

use QuickPdo\QuickPdoInfoTool;

class CrudGeneratorHelper
{

    public static function generateForeignKeyPrettierColumns(array $tables)
    {
        $ret = [];
        foreach ($tables as $table) {
            $fkInfos = QuickPdoInfoTool::getForeignKeysInfo($table);
            foreach ($fkInfos as $fkInfo) {

                $fkTable = $fkInfo[0] . '.' . $fkInfo[1];
                if (!array_key_exists($fkTable, $ret)) {
                    $types = QuickPdoInfoTool::getColumnDataTypes($fkTable, false);
                    foreach ($types as $prettyColumn => $type) {
                        if ('varchar' === $type) {
                            break;
                        }
                    }
                    $ret[$fkTable] = $prettyColumn;
                }
            }
        }
        return $ret;
    }
}
```


But anyway, we end up with an array of table => foreignKeyPreferredColumn.

Let's be creative and call this array table2ForeignKeyPreferredColumn.

And so that's one more word to our vocabulary.


- foreignKeyPreferredColumn
- table2ForeignKeyPreferredColumn

That was just a reminder of the vocabulary we know so far.



























