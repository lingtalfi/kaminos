Generator
================
2017-05-10


The nullos generator generates a phpMyAdmin like admin for the nullos system.


But what does it concretely?



Here is how you call it:

```php
<?php


use Core\Services\A;
use Module\AutoAdmin\CrudGenerator\NullosCrudGenerator;


ini_set('display_errors', "1");
require_once __DIR__ . "/../boot.php";
A::quickPdoInit();


NullosCrudGenerator::create()
    ->useCache(true)
    ->setLogFunction(function ($type, $msg) {
        a($type . ":" . $msg);
    })
    ->setModule("Ekom")
    ->generate('kamille');




```


What the above script does is the following:



1. Call **app/scripts/generator.php** 

2. Generate foreign keys preferred columns in **app/store/AutoAdmin/foreignKeyPreferredColumns/auto/$database.php**.
Those can be manually overridden by **app/store/AutoAdmin/foreignKeyPreferredColumns/manual/$database.php**.

```php
<?php 
$preferredColumns = [
    'ek_country' => 'iso_code',
    'ek_state' => 'iso_code',
    'ek_lang' => 'label',
    'ek_user' => 'email',
    'ek_product_reference' => 'natural_reference',
    'ek_product' => 'product_reference_id',
    'ek_product_attibute_value' => 'label',
    'ek_product_attribute' => 'label',
    'ek_video' => 'uri',
    'ek_shop' => 'label',
    'ek_store' => 'label',
    'ek_role_group' => 'label',
    'ek_role_badge' => 'label',
    'ek_backoffice_user' => 'email',
    'ek_role_profile' => 'label',
    'ek_currency' => 'iso_code',
    'ek_timezone' => 'name',
    'ek_tax_lang' => 'label',
    'ek_tax' => 'reduction',
    'ek_address' => 'type',
    'ek_user_group' => 'label',
];


```


3. Create the skinny types in **app/store/AutoAdmin/skinny-types/auto/$database.php**.
            
```php
<?php

$types = [
    'ek_address' => [
        'id' => 'auto_increment',
        'type' => 'input',
        'city' => 'input',
        'postcode' => 'input',
        'address' => 'input',
        'active' => 'switch',
        'state_id' => 'selectForeignKey',
        'country_id' => 'selectForeignKey',
    ],
    'ek_backoffice_user' => [
        'id' => 'auto_increment',
        'email' => 'input',
        'pass' => 'pass',
        'lang_id' => 'selectForeignKey',
    ],
    //...
];    
```            
            
            

   
   
4. Generate sideBarMenu in **app/store/AutoAdmin/sideBarMenu/auto/$database.php**.
Those can be overridden by **app/store/AutoAdmin/sideBarMenu/manual/$database.php**.


```php
<?php

$items = [
    'icon' => 'fa fa-database',
    'label' => 'kamille',
    'items' => [
        [
            'label' => 'ek_address',
            'link' => '/crud?type=list&prc=Ekom.kamille.ek_address',
            'items' => NULL,
            'icon' => '',
        ],
        [
            'label' => 'ek_backoffice_user',
            'link' => '/crud?type=list&prc=Ekom.kamille.ek_backoffice_user',
            'items' => NULL,
            'icon' => '',
        ],
        [
            'label' => 'ek_cart',
            'link' => '/crud?type=list&prc=Ekom.kamille.ek_cart',
            'items' => NULL,
            'icon' => '',
        ],
        // ...
    ],
];        
```

5. Generate datatable profiles in **app/config/datatable-profiles/$Module/auto/$database/$table.php**.
Can be overridden by **app/config/datatable-profiles/$Module/manual/$database/$table.php**


```php
<?php




$prc = "Ekom.kamille.ek_address";
include __DIR__ . "/../../../NullosAdmin/inc/common.php";


$profile = array_replace_recursive($profile, [
    'model' => [
        'headers' => [
            'id',
            'type',
            'city',
            'postcode',
            'address',
            'active',
            'state_id',
            'country_id',
            'action',
        ],
        'ric' => [
            'id',
        ],
        'actionButtons' => [
            'addItem' => [
                'label' => 'Add Ek_address',
            ],
        ],
    ],
]);

```


6. Generate prc files in **app/class-prc/$Module/$Database/Auto/$TablePersistentRowCollection.php**.
Can be overridden by **app/class-prc/$Module/$Database/$TablePersistentRowCollection.php**.

