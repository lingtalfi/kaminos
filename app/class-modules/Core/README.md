Core module
=================
2017-04-05



Core module for the [kamille framework](https://github.com/lingtalfi/Kamille).




Install
===========
using the [kamille installer tool](https://github.com/lingtalfi/kamille-installer-tool)
```bash
kamille install Core
```


What is it?
==============
This module is a fundamental module in a kamille app,
as it lays down some fundations on which other modules can rely.


Basically, this module owns the dispatch loop (the loop on which the Request is thrown, described in [kam](https://github.com/lingtalfi/kam)),
and so it handles decisions related to that dispatch loop, like choosing the fallback page controller (if no other route matched),
or choosing the exception controller (the controller used if an exception is thrown somewhere, but caught only at the dispatch loop level).

It also provides code level options, like for instance whether or not to display the exception trace in the logs.
 
 
 
 
Configuration keys
====================

- fallbackPageController      
    - description: The default controller used by the static router (if no uri matches)
    - default value: Controller\Core\FallbackPageController:render

- exceptionController
    - description: The exception controller used when an exception was caught at the WebApplicationHandler 
            level (which is btw a bad thing as it should probably be caught earlier).
    - default value: Controller\Core\ExceptionController:render             
- useFileLoggerListener
    - description: Whether or not to use the default useFileLoggerListener provided by the Core module. It will write logs to the file specified with the logFile parameter             
    - default value: true       
- logFile
    - description: This is the log file for the core module (which brings up XLog functionality)
    - default value: $appDir . "/logs/kamille.log.txt" 
- showExceptionTrace
    - description: Whether or not to show the exception trace in the logs. You can use the H::exceptionToString($e) method.
    - default value: true




Hooks
=========

- Core_addLoggerListener: add listeners to the LoggerInterface object (from the [Logger](https://github.com/lingtalfi/logger) planet), 
                        which is then accessible via the XLog object
- Core_feedUri2Controller: feed the array used by the StaticObjectRouter router




Services
===========

- Core_webApplicationHandler: return a WebApplicationHandler instance, which has a handle(WebApplication) method.
            This method wraps the dispatch loop, and basically starts the application instance.
            It is therefore called right from the index.php.




Others
==========
- it uses [lnc1](https://github.com/lingtalfi/layout-naming-conventions#lnc_1) as the layout naming convention




History Log
------------------
    
- 1.0.0 -- 2017-04-05

    - initial commit