Core_autoLawsConfig
======================
2017-04-23



This hook let you override the [laws](https://github.com/lingtalfi/laws) configuration based on the controller instance.


It is called from the ApplicationController class (**app/class-core/Controller/ApplicationController.php**).


It was first used by the NullosAdmin module, so that the NullosAdmin module can load one init js script per controller,
at the bottom of the page, even if the controller is not inside the NullosAdmin context. 

