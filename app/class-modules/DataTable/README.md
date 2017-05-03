DataTable module
=================
2017-05-01 -> 2017-05-03


Bring datatables to your application.

DataTable module for the [kamille framework](https://github.com/lingtalfi/Kamille).




Install
===========
using the [kamille installer tool](https://github.com/lingtalfi/kamille-installer-tool)
```bash
kamille install DataTable
```


Documentation
==============
Parse the [DataTable documentation](https://github.com/KamilleModules/DataTable/tree/master/doc) of this repository to find useful information about the services, hooks, configuration keys, 
controllers, ..., used by this module.
 


What does it bring to you?
---------------------------
Once installed, your other modules can provide their own datatable profiles,
by default in the **app/config/datatable-profiles** directory.

And then, by displaying the html one liner placeholder (and the corresponding js init
code) in an html page, modules can display a full datatable widget in no time.





How does it work?
-------------------

The following schema explains the default synopsis for this module.


[![datatable-module-synopsis.jpg](https://s19.postimg.org/lvqfoazfn/datatable-module-synopsis.jpg)](https://postimg.org/image/rjwqf73rz/)


1. A page is requested
2. The application provides a controller
3. The page displays an empty datatable placeholder, which contains
    a reference to a datatable profile id in its data-id attribute
4. The page then displays the datatable initialization code (making use 
    of the provided datatable jquery plugin)
5. The jquery plugin sends a first ajax request, passing the datatable profile
        id to the DataTableController.
        The DataTableController returns the rendered datatable widget,
        which the jquery plugin places into the view.
        
        After this initial call, the jquery plugin intercepts all 
        user interactions with the datatable widget, passing the corresponding
        parameters to the DataTableController, which role is to render the widget.

6. On the server side, when the DataTableController receives the datatable profile id,
if fetches the corresponding profile array using a ProfileLoader service, which by
default looks into the file system for the following file:
            
            **app/config/datatable-profiles/$profileId.php**
            
With such a system, it's easy for other modules to provide their own datatable profiles.
            The datatable profile allows the customization of all aspects of the 
            rendered datatable widget (or at least most of them).
            
Two examples of such profiles can be found in this repository's **doc** directory.
One using an array based [RowsGenerator](https://github.com/lingtalfi/RowsGenerator), and another 
using a mysql table based RowsGenerator.

However for this second example, the corresponding sql tables are not provided, the example file only
serves the purpose of showing you the syntax of a profile file.
In those two profile files, all of the values are explicitly specified, so that you can see which
properties are available.

However in your own projects, you can get rid of most of them.

In fact, the rowsGenerator section is mandatory, the transformers section is obsolete,
and in the model section, only two keys are "mandatory": ric and headers.

That's it.
            

 

Widget Dependencies
=========
- The DataTable module provides its own widget DataTable_DataTable





History Log
------------------
    
- 1.1.0 -- 2017-05-03

    - clean up
    
- 1.0.0 -- 2017-05-01

    - initial commit