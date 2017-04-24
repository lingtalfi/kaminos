NullosAdminController
========================
2017-04-23


The nullosAdmin controller abstracts a lot of work for you.

Remember that nullos admin uses only two layouts (see [lnc1](https://github.com/lingtalfi/layout-naming-conventions#lnc_1) for more info):

- splash
- admin

Well, the nullosAdmin overrides the renderByViewId (see [laws](https://github.com/lingtalfi/laws) for more info) method of the ApplicationController and provides
some useful methods.




Javascript file autoload
----------------------

A javascript file is automatically loaded, if it exist, and the call to that file is made
at the body end, AFTER the call to the jquery library (all the scripts in the nullos theme
are loaded at the body end, so that the page loads faster).
    
The javascript file name by default is based on the controller name.

So for instance if your controller is: **Controller\NullosAdmin\HomePageController**,
then the following file will be lazily loaded if it exists: **app/www/theme/nullosAdmin/controllers/HomePageController.js**.


This mechanism is implemented inside the Core_autoLawsConfig hook (provided by the Core module).
It basically provides the jsScripts variable, to the layout configuration variables.
 
The jsScripts variable contains uri of javascript files to load. 

And the **common** inclusion file (**app/theme/nullosAdmin/includes/common.php**) reacts to this variable.  




Pre-rendered Admin layout
------------------------------

If the splash layout is easy to create,
the admin layout contains a lot of elements: the sidebar, the top, the bottom, and the main content.

The renderByViewId method of the NullosAdminController let you focus on the main content by providing sensible 
configuration for the sidebar, top and bottom inclusions.

    
    
