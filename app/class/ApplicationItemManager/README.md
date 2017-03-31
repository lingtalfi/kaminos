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



Example
===========
The example below is the core of the [kamille naive importer](https://github.com/lingtalfi/kamille-installer-tool) (aka kamille installer tool ) planet.
 


```php
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
    ->setManager($manager)
    ->setInput($input)
    ->setOutput($output)
    ->start();




```




The logic behind those programs
====================================
This planet can only create one type of program.
It's a program that can import or install items.

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

















History Log
------------------
    
- 1.0.0 -- 2017-03-30





