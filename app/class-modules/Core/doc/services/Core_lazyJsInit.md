Core_lazyJsInit
==================
2017-04-25





This service helps loading js code at the end of the html page,
just before the ending body tag.


Disclaimer:
Core_lazyJsInit uses the HtmlPageHelper object, so if you don't use the HtmlPageHelper object,
there is no point to using the Core_lazyJsInit service.

Disclaimer2:
This service has a shortcut (in the A class) at the application level.

```php

```




The main idea is that if you use a law system, or any other system which make use of widgets,
as a widget author you might want to add javascript code at the end of the page (just before
the ending body tag).

But how do you do that?

Well, the Core_lazyJsInit service is one solution to that problem.

It returns an object with a addJsCode method:

- addJsCode ( group, code )


The group is used to wrap your code with some library specific code,
for instance, you probably know the famous jquery init code, which usually is wrapped within
the following code:

```js
$(document).ready(function () {
    // here is your jquery code
});
```


But since there are other libraries than jquery, we use a specialized object to actually map
a group name (like jquery or any other name), to an actual callback that wraps the code.

You could do it yourself, and repeat the wrapping code every time, and it would probably work too,
but by using group, the code is well factorized. Nice and clean.



So, the Core_lazyJsInit service takes care of registering all the widget calls,
and inject the final result inside the HtmlPageHelper object, which is accessible
via the displayBodyEndSnippets method.





