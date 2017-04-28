Conf
============
2017-04-28





exceptionController
======================
2017-04-28

Default: Controller\Core\ExceptionController:render



The exception controller used when an exception was caught at the
WebApplicationHandler level (which is btw a bad thing as it should
probably be caught earlier).



See [ExceptionController controller](https://github.com/KamilleModules/Core/tree/master/doc/controller/exceptionController.md) for more information.



useFileLoggerListener
======================
2017-04-28

Default: true


Whether or not to use the default useFileLoggerListener provided by the Core module.
It will write logs to the file specified with the logFile configuration key.


logFile
======================
2017-04-28

Default: $appDir . "/logs/kamille.log.txt"

This is the log file for the core module (which brings up XLog functionality)


showExceptionTrace
======================
2017-04-28

Default: false


Whether or not to show the exception trace in the logs.

You can use the A::exceptionToString($e) method.


useCssAutoload
======================
2017-04-28

Default: true

Whether or not to autoload the css files based on their existence at the location defined
in the [laws system (part two)](https://github.com/lingtalfi/laws).
     
Basically, when this is true, you don't need to call the stylesheet from your widget/layout code,
this call will be made for you, as long as you create the stylesheet in the right
location (defined in laws part 2).



database
======================
2017-04-28

Default: kamille


If your application has a main database, you should probably set this configuration key.
This information is for instance used by modules upon installation, so that they can
install their own tables in the existing system.

See the source code of the **Core\Module\ApplicationModule** class for more info.




useDbLoggerListener
======================
2017-04-28

Default: false

If you set this to true, it will intercept all QuickPdo queries an write them 
to the file referenced by the **dbLogFile** config key.




dbLogFile
======================
2017-04-28

Default: $appDir . "/logs/kamille.sql.log.txt"

Location for a db log file. 
By default, it's not used, but if you set the useDbLoggerListener config key to true,
it will intercept all QuickPdo queries an write them to that file.

See Module\Core\CoreHooks::Core_addLoggerListener method for implementation details



useQuickPdo
======================
2017-04-28

Default: true

Whether or not to initialize QuickPdo.
The QuickPdo initialization occurs at the WebApplicationHandler level.


quickPdoConfig
======================
2017-04-28

Default: the following php array

```php 
    $quickPdoConf = [
        "dsn" => "mysql:dbname=$dbName;host=127.0.0.1",
        "user" => "root",
        "pass" => "root",
        "options" => [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        ],
    ];
```



The QuickPdo initialization settings.
Those are used by the Module\Core\Pdo\QuickPdoInitializer 
class, and called from the WebApplicationHandler via the A::QuickPdoInit() method.