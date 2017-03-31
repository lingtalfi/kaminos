ApplicationItemManager
========================
2017-03-30




A planet to help creating certain types of module management console program.


This is part of the [universe framework](https://github.com/karayabin/universe-snapshot).


Install
==========
Download the repository directly, or you can use the [uni importer](https://github.com/lingtalfi/universe-naive-importer):


```bash
uni import ApplicationItemManager
```





Why?
======

If you need to create  a program which can import/install modules/items, this tool can help you.


How?
==========

First, you decide what's an item: is it a module?, a plugin?, a theme? 

Then you can use the ApplicationItemManager.

An ApplicationItemManager is an object that provides useful commands for importing/installing/listing/searching items.
 
 
There is also the ApplicationItemManagerProgram object, which binds the ApplicationItemManager
to a [Program](https://github.com/lingtalfi/program).
  
This combination is useful if your intent is to provide a console api to your program,
which is probably the case.


To use the ApplicationItemManager as a standalone tool, you can use the following example as a starting point:




```php
<?php

use ApplicationItemManager\Importer\GithubImporter;
use ApplicationItemManager\Installer\KamilleModuleInstaller;
use ApplicationItemManager\Installer\KamilleWidgetInstaller;
use ApplicationItemManager\LingApplicationItemManager;
use ApplicationItemManager\Repository\KamilleModulesRepository;
use ApplicationItemManager\Repository\KamilleWidgetsRepository;
use ApplicationItemManager\Repository\LingUniverseRepository;
use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Output\WebProgramOutput;

require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";


$test = "modules";


if ("universe" === $test) {

    //--------------------------------------------
    // UNIVERSE APP MANAGER
    //--------------------------------------------
    $output = WebProgramOutput::create(); // testing from a browser, change this to ProgramOutput to test from cli
    $importDir = "/myphp/kaminos/app/planets";
    $manager = LingApplicationItemManager::create()// the LingApplicationItemManager is just Output friendly
    ->setOutput($output)
        ->addRepository(LingUniverseRepository::create())
        ->bindImporter('ling', GithubImporter::create()->setGithubRepoName("lingtalfi"))
        ->setFavoriteRepositoryId('ling')
        ->setImportDirectory($importDir);


    // below are the most useful commands
    a($manager->search("ba")); // search the term "ba" in the available items
    $manager->listAvailable(); // list the available items
    $manager->install("Bat"); // install the Bat item (will import it if necessary)
    $manager->import("AdminTable"); // import the AdminTable item
    $manager->listImported(); // list the imported items
    $manager->listInstalled(); // list the installed items

} elseif ("widgets" === $test) {
    //--------------------------------------------
    // KAMILLE WIDGETS APP MANAGER
    //--------------------------------------------
    $output = WebProgramOutput::create();
    $appDir = ApplicationParameters::get("app_dir"); // this is specific to the kaminos app I'm testing, don't worry
    LingApplicationItemManager::create()
        ->setOutput($output)
        ->setInstaller(KamilleWidgetInstaller::create()->setOutput($output)->setApplicationDirectory($appDir))
        ->bindImporter('KamilleWidgets', GithubImporter::create()->setGithubRepoName("KamilleWidgets"))
        ->setFavoriteRepositoryId('KamilleWidgets')
        ->setImportDirectory("/myphp/kaminos/app/class-widgets")
        ->addRepository(KamilleWidgetsRepository::create(), ['km'])// notice the km alias, because KamilleWidgets is a long prefix to type
        ->install("BookedMeteo");


} elseif ("modules" === $test) {
    //--------------------------------------------
    // KAMILLE MODULES APP MANAGER
    //--------------------------------------------
    $output = WebProgramOutput::create();
    $appDir = ApplicationParameters::get("app_dir");
    LingApplicationItemManager::create()
        ->setOutput($output)
        ->setInstaller(KamilleModuleInstaller::create()->setOutput($output)->setApplicationDirectory($appDir))
        ->bindImporter('KamilleModules', GithubImporter::create()->setGithubRepoName("KamilleModules"))
        ->setFavoriteRepositoryId('KamilleModules')
        ->setImportDirectory("/myphp/kaminos/app/class-modules")
        ->addRepository(KamilleModulesRepository::create())
        ->install("Connexion");
//        ->uninstall("Connexion");
}






```


There are a few methods available, listed in the ApplicationItemManagerInterface:

- import($item, $force = false)
- install($item, $force = false)
- uninstall($item)
- listAvailable($repoId = null, array $keys = null)
- listImported()
- listInstalled()
- search($text, array $keys = null, $repoId = null)



The most important are perhaps the import and install/uninstall methods.

The algorithm for those methods can be found in this repository: I made two pdf documents
describing those algorithms, in the "design" directory of this repository.

- https://github.com/lingtalfi/ApplicationItemManager/blob/master/doc/design/ApplicationItemManager-import-install-item-algo.pdf
- https://github.com/lingtalfi/ApplicationItemManager/blob/master/doc/design/ApplicationItemManager-uninstall-item-algo.pdf





Creating Console Programs
============================


Once you've configured an ApplicationItemManager instance to your likings,
you can create a console program out of it.

The ApplicationItemManagerProgram object helps you a long way with that, encapsulating 
your ApplicationItemManager instance and providing program commands for free (using the
[Program](https://github.com/lingtalfi/program) planet under the hood):





```txt
Usage
-------

The word item is defined like this:
- item: itemId | itemName
- itemId: repositoryId.itemName | repositoryAlias.itemName



myprog import {item}                       # import an item and its dependencies, skip already existing item(s)/dependencies
myprog import -f {item}                    # import an item and its dependencies, replace already existing item(s)/dependencies
myprog install {item}                      # install an item and its dependencies, will import them if necessary, skip already existing item(s)/dependencies
myprog install -f {item}                   # install an item and its dependencies, will import them if necessary, replace already existing item(s)/dependencies
myprog uninstall {item}                    # call the uninstall method on the given item and dependencies
myprog list {repoAlias}?                   # list available items
myprog listd {repoAlias}?                  # list available items with their description if any
myprog listimported                        # list imported items
myprog listinstalled                       # list installed items
myprog search {term} {repoAlias}?          # search through available items names
myprog searchd {term} {repoAlias}?         # search through available items names and/or description
myprog clean                               # removes the .git, .gitignore, .idea and .DS_Store files in your items directories, recursively


For instance:
    myprog import Connexion
    myprog import km.Connexion
    myprog import -f Connexion
    myprog import -f km.Connexion
    myprog install Connexion
    myprog install km.Connexion
    myprog install -f Connexion
    myprog install -f km.Connexion
    myprog uninstall Connexion
    myprog uninstall km.Connexion
    myprog list
    myprog list km
    myprog listd
    myprog listd km
    myprog listimported
    myprog listinstalled
    myprog search ling
    myprog search ling km
    myprog searchd kaminos
    myprog searchd kaminos km
    myprog clean
```






Here is the code required to create such a console program.
The example below use the ApplicationItemManager for the universe.



```php
#!/usr/bin/env php
<?php


use ApplicationItemManager\Importer\GithubImporter;
use ApplicationItemManager\LingApplicationItemManager;
use ApplicationItemManager\Program\ApplicationItemManagerProgram;
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

```





The logic behind those programs
====================================

This planet can only create one type of program.
It's a program that can import or install items, and also has listing capabilities (listing and searching, actually).

An item can be what you want it to be: a module, a theme, a widget, ...


Basically, you first import an item, then you can install it.
Not all items need to be installed (this depends on your own requirements), some items can be imported only.


An item might have dependencies to other items.

When you import an item, its dependencies are automatically imported too.


Importing means copy a distant directory to a location in your app.

This is done by Importer objects.

An Importer encapsulates the technique of importing a given item.
For instance, the GithubImporter knows how to retrieve an item from a github repository.

In theory, a ComposerImporter could retrieve an item from the composer's repository, but I didn't create such
an Importer yet, but you get the idea.


Once the item is imported into your application, you can then install it.

Your item needs to provide methods for installing and uninstalling itself into your application.

Installing means for example creating the tables in a database, copying files into the application, things like that...

By default, it is assumed that those methods are called install and uninstall, but this is configurable.


There is an ItemList object, which helps searching for an item, and resolving dependencies for your items.

Basically, an ItemList object contains all the meta info about your items, including its dependencies.

Finally, there is the concept of hard dependency.

A hard dependency is a dependency such as when you uninstall a parent, all children having hard dependencies
to that parent are also uninstalled.

It's like the cascading effect in mysql: if you delete a record in a table, it can delete records in some "child"
tables, using cascading mode.

Basically the idea behind a hard dependency is that some items don't have any reason to live without their parent item.


Hopefully this overview will help you understand/manipulate the class in this planets.

Some programs which use this system are:

- [uni](https://github.com/lingtalfi/universe-naive-importer) (the universe naive importer)
- [kamille installer tool](https://github.com/lingtalfi/kamille-installer-tool) (which can install modules and widgets)











Playing with code
=====================


Testing repositories
----------------------

```php


//--------------------------------------------
// TESTING REPOSITORIES
//--------------------------------------------
a(KamilleModulesRepository::create()->getDependencies("KamilleModules.Connexion"));
a(KamilleModulesRepository::create()->getHardDependencies("KamilleModules.Connexion"));
a(LingUniverseRepository::create()->getDependencies("ling.ArrayStore"));
```











History Log
------------------
    
- 1.0.0 -- 2017-03-30





