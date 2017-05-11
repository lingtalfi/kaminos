<?php

$types = [
    'ek_address' => [
        'id' => 'auto_increment',
        'type' => 'input',
        'city' => 'input',
        'postcode' => 'input',
        'address' => 'input',
        'active' => 'switch',
        'state_id' => 'selectForeignKey+query=select id, iso_code from kamille.ek_state+firstOptionLabel=Please choose an option+firstOptionValue=0',
        'country_id' => 'selectForeignKey+query=select id, iso_code from kamille.ek_country',
    ],
    'ek_backoffice_user' => [
        'id' => 'auto_increment',
        'email' => 'input',
        'pass' => 'pass',
        'lang_id' => 'selectForeignKey+query=select id, label from kamille.ek_lang',
    ],
    'ek_cart' => [
        'id' => 'auto_increment',
        'items' => 'textarea',
        'user_id' => 'selectForeignKey+query=select id, email from kamille.ek_user',
    ],
    'ek_country' => [
        'id' => 'auto_increment',
        'iso_code' => 'input',
    ],
    'ek_country_lang' => [
        'country_id' => 'selectForeignKey+query=select id, iso_code from kamille.ek_country',
        'lang_id' => 'selectForeignKey+query=select id, label from kamille.ek_lang',
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
        'product_reference_id' => 'selectForeignKey+query=select id, natural_reference from kamille.ek_product_reference+firstOptionLabel=Please choose an option+firstOptionValue=0',
    ],
    'ek_product_attibute_value' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'lang_id' => 'selectForeignKey+query=select id, label from kamille.ek_lang',
    ],
    'ek_product_attribute' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'lang_id' => 'selectForeignKey+query=select id, label from kamille.ek_lang',
    ],
    'ek_product_has_product_attribute' => [
        'product_id' => 'selectForeignKey+query=select id, product_reference_id from kamille.ek_product',
        'product_attribute_id' => 'selectForeignKey+query=select id, label from kamille.ek_product_attribute',
        'product_attibute_value_id' => 'selectForeignKey+query=select id, label from kamille.ek_product_attibute_value',
    ],
    'ek_product_has_video' => [
        'product_id' => 'selectForeignKey+query=select id, product_reference_id from kamille.ek_product',
        'video_id' => 'selectForeignKey+query=select id, uri from kamille.ek_video',
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
        'shop_id' => 'selectForeignKey+query=select id, label from kamille.ek_shop',
        'product_reference_id' => 'selectForeignKey+query=select id, natural_reference from kamille.ek_product_reference',
    ],
    'ek_product_reference_store' => [
        'id' => 'auto_increment',
        'store_id' => 'selectForeignKey+query=select id, label from kamille.ek_store',
        'quantity' => 'input',
        'product_reference_id' => 'selectForeignKey+query=select id, natural_reference from kamille.ek_product_reference',
    ],
    'ek_role_badge' => [
        'id' => 'auto_increment',
        'label' => 'input',
    ],
    'ek_role_group' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'role_group_id' => 'selectForeignKey+query=select id, label from kamille.ek_role_group+firstOptionLabel=Please choose an option+firstOptionValue=0',
    ],
    'ek_role_group_has_role_badge' => [
        'role_group_id' => 'selectForeignKey+query=select id, label from kamille.ek_role_group',
        'role_badge_id' => 'selectForeignKey+query=select id, label from kamille.ek_role_badge',
    ],
    'ek_role_profile' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'backoffice_user_id' => 'selectForeignKey+query=select id, email from kamille.ek_backoffice_user',
    ],
    'ek_role_profile_has_role_badge' => [
        'role_profile_id' => 'selectForeignKey+query=select id, label from kamille.ek_role_profile',
        'role_badge_id' => 'selectForeignKey+query=select id, label from kamille.ek_role_badge',
    ],
    'ek_role_profile_has_role_group' => [
        'role_profile_id' => 'selectForeignKey+query=select id, label from kamille.ek_role_profile',
        'role_group_id' => 'selectForeignKey+query=select id, label from kamille.ek_role_group',
    ],
    'ek_shop' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'lang_id' => 'selectForeignKey+query=select id, label from kamille.ek_lang+firstOptionLabel=Please choose an option+firstOptionValue=0',
        'currency_id' => 'selectForeignKey+query=select id, iso_code from kamille.ek_currency+firstOptionLabel=Please choose an option+firstOptionValue=0',
        'timezone_id' => 'selectForeignKey+query=select id, name from kamille.ek_timezone+firstOptionLabel=Please choose an option+firstOptionValue=0',
    ],
    'ek_shop_has_product' => [
        'shop_id' => 'selectForeignKey+query=select id, label from kamille.ek_shop',
        'product_id' => 'selectForeignKey+query=select id, product_reference_id from kamille.ek_product',
        'active' => 'switch',
    ],
    'ek_shop_has_store' => [
        'shop_id' => 'selectForeignKey+query=select id, label from kamille.ek_shop',
        'store_id' => 'selectForeignKey+query=select id, label from kamille.ek_store',
    ],
    'ek_state' => [
        'id' => 'auto_increment',
        'iso_code' => 'input',
        'label' => 'input',
        'country_id' => 'selectForeignKey+query=select id, iso_code from kamille.ek_country',
    ],
    'ek_store' => [
        'id' => 'auto_increment',
        'label' => 'input',
    ],
    'ek_tax' => [
        'id' => 'auto_increment',
        'reduction' => 'input',
        'tax_lang_id' => 'selectForeignKey+query=select id, label from kamille.ek_tax_lang',
    ],
    'ek_tax_lang' => [
        'id' => 'auto_increment',
        'label' => 'input',
        'lang_id' => 'selectForeignKey+query=select id, label from kamille.ek_lang',
    ],
    'ek_tax_rule' => [
        'id' => 'auto_increment',
        'tax_id' => 'selectForeignKey+query=select id, reduction from kamille.ek_tax',
        'condition' => 'input',
    ],
    'ek_timezone' => [
        'id' => 'auto_increment',
        'name' => 'input',
    ],
    'ek_user' => [
        'id' => 'auto_increment',
        'user_group_id' => 'selectForeignKey+query=select id, label from kamille.ek_user_group',
        'email' => 'input',
        'pass' => 'pass',
        'base_shop_id' => 'input',
        'date_creation' => 'datetime',
        'active' => 'switch',
        'main_address_id' => 'selectForeignKey+query=select id, type from kamille.ek_address',
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
