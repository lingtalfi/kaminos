Laws
========================
2017-03-27


Layouts and widgets.



So now we are inside the Controller.
We want to render an html page (assuming a web application).

There are many ways to render an html page.
One is to use the Laws module, which mechanism is described below.




Modules which use the laws system will provide their (laws) conf during their installation phase.
Since Laws is a system I plan to use a lot, there will be install/uninstall helpers at the KaminosModule level.
 
Basically, the goal is to achieve the following tree structure:


```txt
- app
----- config
--------- modules
------------- ?Laws.conf.php
------------- laws
----------------- layoutId.conf.php   # layoutId: layoutModel.moduleName
----- class-modules
--------- Module1
------------- laws
----------------- Module1.laws.conf.php
--------- Module2
------------- laws
----------------- Module2.laws.conf.php
----- theme
--------- themeName
------------- layout
----------------- nameOfTheModel                # just trying a convention here, if it works it will be kept
--------------------- templateName.tpl.php      # templateName: moduleBasedName.nameOfTheModel        
------------- widget
----------------- nameOfTheModel        # just trying a convention here, if it works it will be kept. The model is actually the short className in this case
--------------------- templateName.tpl.php      # templateName: moduleBasedName.nameOfTheModel
```



So, basically the goal is that modules bring their own config files in the **app/config/modules/laws** directory.
The first idea was to gather all the configurations together into the **app/config/modules/Laws.conf.php** file,
but then I thought that this would not be optimized for the performances, as it would imply loading all the layout configs
when we just need ONE layout config.

Here is an imaginary content representing a given laws config file:
  
```php
<?php 

$conf = [
    'models' => [
        'nameOfTheModel' => [
            'position1',
            'position2',
        ],    
    ],
    'layouts' => [
        'layoutId' => [
            'model' => 'nameOfTheModel',     
            // passed through a loader object, will be later converted to an actual template content,
            // we use the loader/renderer pattern here (https://github.com/lingtalfi/loader-renderer-pattern/blob/master/loader-renderer.pattern.md)
            'template' => 'templateName',    
            // 'renderer' => null, // experimental, used in case we want to override the default renderer class, might not be used      
            // 'loader' => null, // experimental, used in case we want to override the default loader class, might not be used
            'conf' => [
                'someVar' => 'someValue',    
            ],   
        ],    
    ],
    'widgets' => [
        'layoutId.position.index' => [
            'class' => 'nameOfTheClass',     
            'template' => 'templateName',        
            'conf' => [ // widget related conf
                'someVar' => 'someValue',
            ],        
        ],    
    ],
];
```



Time for some nomenclature.


Nomenclature
===================
A layout is an html template, it uses positions (as placeholders).

Then we have widgets.
A widget is bound to a position.

So for instance a layout can provide two positions: top and bottom.
And we can bind any number of widgets to those positions.

Laws works with a themable application.
So a theme allows us to switch the look'n'feel of our web application in one fell swoop.

An important idea is that modules can bring their own templates to the mix.
That's why I added some conventions at the tree structure level, so that name conflicts between module's templates
are avoided.

An other important concept is the layoutId.
It basically identifies a unique layout, which is a template using some given positions, 
each position having some widgets bound to it.

So, by choosing the layoutId, we can choose the "look'n'feel" of our html page.


It's also important to note that different templates for a same thing (layout or widget) might use different
variables.
So, a template can have some specific variables, but they are merged in the conf variables as far as the 
configuration file is concerned.



Desired mechanism
=============

At this point, I'm just at the conception level, so things might change,
nonetheless my idea is the following:

there will be a Laws module service which will allow to render a layout based on a given layoutId.
It will also allow us to override any parameter (layout or widget) from the controller.

It's also important that we can render either a simple widget or a position (groups of widgets) from the layout template.
This gives us more flexibility, and so for instance we can use a "group" template which wraps every widget in a group,
but this group template is not used for rendering a single widget.














