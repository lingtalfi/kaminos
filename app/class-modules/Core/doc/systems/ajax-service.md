Ajax services
===================
2017-05-10



The Core module provides a mechanism to handle ajax services.

A ServiceController is created, intercepting every call starting with the "/service/" prefix.

This controller internally dispatch the request to a simple php file (which is easier to create than a controller).

Here is how the tree structure is:
 
 
```txt
- app
----- service
--------- $type
------------- $ModuleName
----------------- $serviceName.php

``` 


So, a user calls the following uri: **$type/$ModuleName/$serviceName**,
and the controller calls the **app/service/$type/$ModuleName/$serviceName.php** file,
which should only define one variable: $out.

The **$out** variable is then returned by the controller.

In the case of a gscp service, then the **$type** variable must also be returned.

 
 
Type
-------
$type represents the type of output generated.
It can be one of those:

- json: returns a json repsonse
- gscp: returns a gscp response (json formatted in a certain way)
- html: returns html code

Or can even be extended as necessary.


