ModalContent
===============
2017-05-06



Widget for displaying a ModalContent.




This is a widget for the [kamille framework](https://github.com/lingtalfi/Kamille).


Install
===========
using the [kamille installer tool](https://github.com/lingtalfi/kamille-installer-tool)
```bash
kamille winstall ModalContent
```



Model
===========

The model used by this widget contains the following variables:

- type: string, the type of modal (for instance error, warning, info, ...)
- title: string|null: the title of the modal if any, or null if there is no title
- message: the modal content message







Demo snippet
=========

```php
<?php


$conf = [
    "layout" => [
        "tpl" => "ajax/default",
    ],
    "widgets" => [
        "main.modalContent" => [
            "tpl" => "ModalContent/default",
            "conf" => [
                "type" => "error",
                "title" => "404",
                "message" => "Page not found",
            ],
        ],
    ],
];
```






History Log
------------------

- 1.0.0 -- 2017-05-06

    - initial commit