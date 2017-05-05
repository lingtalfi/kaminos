<?php


use FormModel\Control\InputPasswordControl;
use FormModel\Control\InputTextControl;
use FormModel\FormModel;



$formModel = FormModel::create()
    ->addFormAttribute('class', "form-horizontal form-label-left")
    ->setFormErrorPosition('central')
    ->addControl("name", InputTextControl::create()
        ->label("name")
        ->name("name")
    )
    ->addControl("password", InputPasswordControl::create()
        ->label("password")
        ->name("pass")
    );
