Implementation notes
=====================
2017-04-09



At some point, I will want widgets to be configurable via the gui.

This means, the laws conf files will be configurable from the gui.

However, observing some laws conf files, they use the full php power (variables references for instance),
like this one for instance:

```php
<?php


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;

$theme = ApplicationParameters::get("theme");

$conf = [
    "layout" => [
        "name" => "splash/default",
    ],
    "widgets" => [
        "main.maintenance" => [
            "name" => "maintenance/default",
            "conf" => [
                "logo_src" => "theme/$theme/widgets/maintenance/logo.png",
                "logo_alt" => "logo",
                "main_text" => "Our website is currently down for maintenance.",
                "aux_text" => "We expect to be back in a couple of hours. Thanks for your patience.",
                "image_src" => "theme/$theme/widgets/maintenance/maintenance.png",
                "image_alt" => "maintenance",
            ],
        ],
    ],
];
```


And that's just an example.
So, my question was: how to you update this file without removing those variables (and comments by the way)?

The obvious answer (although not first that had came in my mind) is:
you need to play with tokens.

That's because you don't want to remove the php power from the hands of the user (that was the
first idea that came in my mind), it just sounds unacceptable.

So playing with tokens is the only way out, not a trivial task, but a necessary one.


