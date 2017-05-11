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
    'ek_cart' => [
        'id' => 'auto_increment',
        'items' => 'textarea',
        'user_id' => 'selectForeignKey',
    ],
    'ek_country' => [
        'id' => 'auto_increment',
        'iso_code' => 'input',
    ],
    'ek_country_lang' => [
        'country_id' => 'selectForeignKey',
        'lang_id' => 'selectForeignKey',
        'label' => 'input',
    ],
    'ek_currency' => [
        'id' => 'auto_increment',
        'iso_code' => 'input',
        'symbol' => 'input',
        'exchange_rate' => 'input',
    ],
    'ek_lang' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'iso_code' => 'input',
    ],
    'ek_product' => [
        'id' => 'auto_increment',
        'product_reference_id' => 'selectForeignKey',
    ],
    'ek_product_attibute_value' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'lang_id' => 'selectForeignKey',
    ],
    'ek_product_attribute' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'lang_id' => 'selectForeignKey',
    ],
    'ek_product_has_product_attribute' => [
        'product_id' => 'selectForeignKey',
        'product_attribute_id' => 'selectForeignKey',
        'product_attibute_value_id' => 'selectForeignKey',
    ],
    'ek_product_has_video' => [
        'product_id' => 'selectForeignKey',
        'video_id' => 'selectForeignKey',
    ],
    'ek_product_reference' => [
        'id' => 'auto_increment',
        'natural_reference' => 'input',
        'reference' => 'input',
        'weight' => 'input',
    ],
    'ek_product_reference_shop' => [
        'id' => 'auto_increment',
        'image' => 'upload+profileId=Ekom/kamille.ek_product_reference_shop.image',
        'prix_ht' => 'input',
        'shop_id' => 'selectForeignKey',
        'product_reference_id' => 'selectForeignKey',
    ],
    'ek_product_reference_store' => [
        'id' => 'auto_increment',
        'store_id' => 'selectForeignKey',
        'quantity' => 'input',
        'product_reference_id' => 'selectForeignKey',
    ],
    'ek_role_badge' => [
        'id' => 'auto_increment',
        'label' => 'input',
    ],
    'ek_role_group' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'role_group_id' => 'selectForeignKey',
    ],
    'ek_role_group_has_role_badge' => [
        'role_group_id' => 'selectForeignKey',
        'role_badge_id' => 'selectForeignKey',
    ],
    'ek_role_profile' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'backoffice_user_id' => 'selectForeignKey',
    ],
    'ek_role_profile_has_role_badge' => [
        'role_profile_id' => 'selectForeignKey',
        'role_badge_id' => 'selectForeignKey',
    ],
    'ek_role_profile_has_role_group' => [
        'role_profile_id' => 'selectForeignKey',
        'role_group_id' => 'selectForeignKey',
    ],
    'ek_shop' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'lang_id' => 'selectForeignKey',
        'currency_id' => 'selectForeignKey',
        'timezone_id' => 'selectForeignKey',
    ],
    'ek_shop_has_product' => [
        'shop_id' => 'selectForeignKey',
        'product_id' => 'selectForeignKey',
        'active' => 'switch',
    ],
    'ek_shop_has_store' => [
        'shop_id' => 'selectForeignKey',
        'store_id' => 'selectForeignKey',
    ],
    'ek_state' => [
        'id' => 'auto_increment',
        'iso_code' => 'input',
        'label' => 'input',
        'country_id' => 'selectForeignKey',
    ],
    'ek_store' => [
        'id' => 'auto_increment',
        'label' => 'input',
    ],
    'ek_tax' => [
        'id' => 'auto_increment',
        'reduction' => 'input',
        'tax_lang_id' => 'selectForeignKey',
    ],
    'ek_tax_lang' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'lang_id' => 'selectForeignKey',
    ],
    'ek_tax_rule' => [
        'id' => 'auto_increment',
        'tax_id' => 'selectForeignKey',
        'condition' => 'input',
    ],
    'ek_timezone' => [
        'id' => 'auto_increment',
        'name' => 'input',
    ],
    'ek_user' => [
        'id' => 'auto_increment',
        'user_group_id' => 'selectForeignKey',
        'email' => 'input',
        'pass' => 'pass',
        'base_shop_id' => 'input',
        'date_creation' => 'datetime',
        'active' => 'switch',
        'main_address_id' => 'selectForeignKey',
        'mobile' => 'input',
        'phone' => 'input',
        'pro' => 'switch',
    ],
    'ek_user_group' => [
        'id' => 'input',
        'label' => 'input',
    ],
    'ek_video' => [
        'id' => 'auto_increment',
        'uri' => 'input',
    ],
];
