Laws
========================
2017-03-27 --> 2017-03-28


Layouts and widgets.



So now we are inside the Controller.
We want to render an html page (assuming a web application).

There are many ways to render an html page.
One is to use the Laws system (installing the Laws module), which is described below.


LAWS stands for LAyouts and WidgetS.


When you open an uri in your browser, what you see is a page (an html page).
A layout renders/displays a page.

A page is brought by a module.
Actually, a module usually brings a set of related pages.

Can two different modules bring the same page?
Yes.
In the example below, we have three imaginary modules: Ecom, Blog and Error.
They all bring their set of pages, and there are some duplicates.

```txt
- Ecom Module
----- login
----- product
----- home
----- mycart

- Blog Module
----- login
----- blog
----- home

- Error Module
----- error
----- 404
```


A layout is like the architecture of the page, its foundations, whereas the widgets are the flesh of the page,
if I may say.

The html code of a layout is contained inside a template.
The html code of widgets is also contained inside a template.


A layout uses positions.
We attach widgets to those positions.
Positions are a convenient way to group widgets, and to manipulate a group of widgets as a whole.

A layout can either call a widget directly.
or render a position which in turn renders all the widgets attached to it

When you display widgets using positions, you can wrap each widget with an html code (to emphasize
the separation of the widgets).
The wrapper code is also put in a separated template called position template.
More often than not, the position templates are re-used from a position to the other.

Below is the file organization of the theme directory, which contains the layout, widget, and position templates.
Note that this is just a convention that I suggest (and will implement for myself).

```txt
- themeName
----- layout
--------- layoutModel
------------- moduleName.layoutModel.tpl.php
----- widget
--------- layoutModel
------------- moduleName.layoutModel.tpl.php
----- position
--------- layoutModel
------------- moduleName.layoutModel.tpl.php
--------- _common_      # an imaginary fallback directory, since it is not likely that every module brings its own position template(s) 

```

Note that the naming system above allow this idea that different modules can bring the same page.


Modules which use the laws system will provide their (laws) conf during their installation phase.
Since Laws is a system I plan to use a lot, there will be install/uninstall helpers at the KaminosModule level.
 
Basically, the goal is to achieve the following tree structure:


```txt
- app
----- config
--------- modules
------------- ?Laws.conf.php                                # not used for now
------------- laws
----------------- layoutId.conf.php                         # layoutId: layoutModel.moduleName
----- class-modules
--------- Module1
------------- files
----------------- app
---------------------- config
-------------------------- modules
------------------------------- laws
----------------------------------- layoutId.conf.php       # layoutId: layoutModel.Module1 for instance
--------- Module2
------------- files
----------------- app
---------------------- config
-------------------------- modules
------------------------------- laws
----------------------------------- layoutId.conf.php       # layoutId: layoutModel.Module2 for instance
```



Note: the layoutModel is usually the pageName (but not always).



So, basically the goal is that modules bring their own config files in the **app/config/modules/laws** directory.
The first idea was to gather all the configurations together into the **app/config/modules/Laws.conf.php** file,
but then I thought that this would not be optimized for the performances: loading a whole file when you don't need
every bit of data is generally a bad idea.



Now about the laws config file.
The layoutId.conf.php file contains all the information necessary to recreate a full-featured layout object.
The layoutId is just an identifier so that we can refer to a specific config file from the userland code
(and probably a loader object).

Here is an imaginary content representing a given laws config file:
  
```php
<?php 

$conf = [
    'layout' => [
        'template' => 'templateName',    
        'loader' => null,    
        'renderer' => null,    
        'conf' => [
            'someVar' => 'someValue',    
        ],       
    ],
    'widgets' => [
        'widgetId' => [  
            'template' => 'templateName',     
            'class' => 'nameOfTheClass',     
            'loader' => null,    
            'renderer' => null,        
            'conf' => [ // widget related conf
                'someVar' => 'someValue',
            ],        
        ],    
    ],
    'positions' => [
        'positionName' => [
            'template' => 'templateName',        
            'class' => 'nameOfTheClass',     
            'conf' => [ // widget related conf
                'someVar' => 'someValue',
            ],        
        ],    
    ],
];
```

Note: the widget id depends on how the widget is used.

If it's called as a widget, then we have:
```txt
widgetId: className(-index)
```

If it's called via a position, then we have:
```txt
widgetId: positionName.className(-index)
```

The index optional suffix helps differentiate multiple instances of the same widgets
used inside the same layout.


This is just the convention though, you don't have to use it if you don't want to;
the widgetId can actually be anything.


You might wonder why I didn't include the moduleName in the widgetId?
That's because the whole file (layoutId.conf.php) already contains the module name (remember: layoutId: moduleName.pageName)


The code inside a template (a layout template or a widget template) is interpreted by a renderer object.
What makes LAWS peculiar, amongst other things, is that the Renderer object is used both by the layout
template AND the widget template, so both the layout or the widget template can use the same mechanisms.

The renderer used provides a LayoutProxy object, referenced as $l inside the template,
and which contains two methods:

- widget (widgetName)
- position (positionName)

The first renders a widget with name=widgetName.
The second renders a position with name=positionName.

So inside your layout or widget template, you'll be able to find code like this:

```php
$l->widget( widgetId );
// and/or
$l->position( positionName );
```






