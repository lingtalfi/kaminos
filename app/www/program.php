#!/usr/bin/env php
<?php


use ApplicationItemManager\Importer\GithubImporter;
use ApplicationItemManager\Installer\KamilleWidgetInstaller;

use ApplicationItemManager\LingApplicationItemManager;
use ApplicationItemManager\Program\ApplicationItemManagerProgram;
use ApplicationItemManager\Repository\KamilleWidgetsRepository;
use ApplicationItemManager\Repository\LingUniverseRepository;
use CommandLineInput\ProgramOutputAwareCommandLineInput;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Output\ProgramOutput;

//--------------------------------------------
// UNIVERSE PROGRAM
//--------------------------------------------
$_SERVER['APPLICATION_ENVIRONMENT'] = "dev"; // hack environment here depending on your prefs
require_once __DIR__ . "/../boot.php"; // start your autoloaders...

$output = ProgramOutput::create();
$appDir = ApplicationParameters::get("app_dir");
$importDir = "/myphp/kaminos/app/planets";
$manager = LingApplicationItemManager::create()
    ->setOutput($output)
    ->addRepository(LingUniverseRepository::create(), ['km'])
    ->setFavoriteRepositoryId('ling')
    ->bindImporter('ling', GithubImporter::create()->setGithubRepoName("lingtalfi"))
    ->setImportDirectory($importDir);


$input = ProgramOutputAwareCommandLineInput::create($argv)
    ->setProgramOutput($output)
    ->addFlag("f")
    ->addFlag("v");

ApplicationItemManagerProgram::create()
    ->setManager($manager)
    ->setInput($input)
    ->setOutput($output)
    ->setImportDirectory($importDir)
    ->start();


exit;


$_SERVER['APPLICATION_ENVIRONMENT'] = "dev"; // hack environment here depending on your prefs
require_once __DIR__ . "/../boot.php"; // start your autoloaders...




$output = ProgramOutput::create();
$appDir = ApplicationParameters::get("app_dir");
$manager = LingApplicationItemManager::create()
    ->setOutput($output)
    ->addRepository(KamilleWidgetsRepository::create(), ['km'])
    ->setFavoriteRepositoryId('KamilleWidgets')
    ->bindImporter('KamilleWidgets', GithubImporter::create()->setGithubRepoName("KamilleWidgets"))
    ->setImportDirectory("/myphp/kaminos/app/class-widgets")
    ->setInstaller(KamilleWidgetInstaller::create()->setOutput($output)->setApplicationDirectory($appDir));


$input = ProgramOutputAwareCommandLineInput::create($argv)
    ->setProgramOutput($output)
    ->addFlag("f")
    ->addFlag("v");

ApplicationItemManagerProgram::create()
    ->setManager($manager)
    ->setInput($input)
    ->setOutput($output)
    ->start();



