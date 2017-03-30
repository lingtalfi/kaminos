#!/usr/bin/env php
<?php


use ApplicationItemManager\Importer\GithubImporter;
use ApplicationItemManager\Installer\KamilleWidgetInstaller;
use ApplicationItemManager\ItemList\KamilleWidgetsItemList;
use ApplicationItemManager\LingApplicationItemManager;
use ApplicationItemManager\Program\ApplicationItemManagerProgram;
use CommandLineInput\ProgramOutputAwareCommandLineInput;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Output\ProgramOutput;

//--------------------------------------------
//
//--------------------------------------------


$_SERVER['APPLICATION_ENVIRONMENT'] = "dev"; // hack environment here depending on your prefs
require_once __DIR__ . "/../boot.php"; // start your autoloaders...

$output = ProgramOutput::create();
$appDir = ApplicationParameters::get("app_dir");
$manager = LingApplicationItemManager::create()
    ->setOutput($output)
    ->setInstaller(KamilleWidgetInstaller::create()->setOutput($output)->setApplicationDirectory($appDir))
    ->bindImporter('KamilleWidgets', GithubImporter::create()->setGithubRepoName("KamilleWidgets"))
    ->setDefaultImporter('KamilleWidgets')
    ->setImportDirectory("/myphp/kaminos/app/class-widgets")
    ->addItemList(KamilleWidgetsItemList::create());


$input = ProgramOutputAwareCommandLineInput::create($argv)
    ->setProgramOutput($output)
    ->addFlag("f");

ApplicationItemManagerProgram::create()
    ->addAlias("km", "KamilleWidgets")
    ->setManager($manager)
    ->setInput($input)
    ->setOutput($output)
    ->start();



