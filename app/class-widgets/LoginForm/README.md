LoginForm
===============
2017-04-21



Widget for displaying a LoginForm.




This is a widget for the [kamille framework](https://github.com/lingtalfi/Kamille).


Install
===========
using the [kamille installer tool](https://github.com/lingtalfi/kamille-installer-tool)
```bash
kamille winstall LoginForm
```



Model
===========

The model used by this widget contains the following variables:

- title: string|null, the title of the form
- formModel: object|null, a [FormRenderer](https://github.com/lingtalfi/FormRenderer) (using the [form model](https://github.com/lingtalfi/FormModel))
- showForgotPasswordLink: bool, whether or not to show the the "forget password" link
- uriForgotPassword: string, uri to the forgot password page
- textForgotPassword: string, text of the forgot password link
- showCreateAccountLink: bool, whether or not to show the the "create account" link
- uriCreateAccount: string, uri to the create account page
- textCreateAccount: string, text of the create account link
- textNewToSite: string, an extra text accompanying the create account link
- textSubmit: string, the text of the submit button







Demo snippet
=========

```php
<?php


$t = "widgets/LoginForm/LoginForm";

$conf = [
    "layout" => [
        "tpl" => "splash/default",
        "conf" => [],
    ],
    "widgets" => [
        "main.notification" => [
            /**
             * Primary goal/intent of notification: be a companion for a form
             */
            "tpl" => "Notification/default",
            "conf" => [],
        ],
        "main.loginForm" => [
            "tpl" => "LoginForm/default",
            "conf" => [
                "title" => __("loginForm", $t),
                "formModel" => null, // to be set by the controller


                "showForgotPasswordLink" => true,
                "uriForgotPassword" => "/password-forgotten",
                "textForgotPassword" => __("passwordLost", $t),
                "showCreateAccountLink" => true,
                "uriCreateAccount" => "/create-account",
                "textCreateAccount" => __("createAccount", $t),
                "textNewToSite" => __("newToSite", $t),
                "textSubmit" => __("submit", $t),
            ],
        ],
    ],
];
```






History Log
------------------

- 1.1.0 -- 2017-04-22

    - add textSubmit
    
- 1.0.0 -- 2017-04-21

    - initial commit