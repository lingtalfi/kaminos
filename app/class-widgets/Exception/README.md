Exception
===============
2017-04-04



Widget for displaying an exception.




This is a widget for the [kamille framework](https://github.com/lingtalfi/Kamille).


[![exception.png](https://s19.postimg.org/narypho0z/exception.png)](https://postimg.org/image/qudwfaqqn/)




Install
===========
using the [kamille installer tool](https://github.com/lingtalfi/kamille-installer-tool)
```bash
kamille winstall Exception
```



Model
===========

This model contains the following variables:

- exception: \Exception, the exception object
- showMessage: bool, whether or not to show the exception message
- showLine: bool, whether or not to show the exception line
- showFile: bool, whether or not to show the exception file
- showCode: bool, whether or not to show the exception code
- showTrace: bool, whether or not to show the exception trace





Demo snippet
===============

```php
<?php



$e = null;
try{
    throw new \Exception("eee");
}
catch(\Exception $e){

}


$conf = [
    "layout" => [
        "name" => "splash/default",
    ],
    "widgets" => [
        "main.exception" => [
            "name" => "Exception/default",
            "conf" => [
                /**
                 * Normally, you would provide this exception from a controller or another mean,
                 * but for this demo, I'm providing a self baked exception.
                 */
                "exception" => $e,
                "showMessage" => true,
                "showTrace" => true,
                "showFile" => true,
                "showCode" => true,
                "showLine" => true,
            ],
        ],
    ],
];
```







History Log
------------------
    
- 1.1.0 -- 2017-04-07

    - add css file
    
- 1.0.0 -- 2017-04-04

    - initial commit