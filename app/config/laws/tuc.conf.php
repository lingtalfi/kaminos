<?php


use FormModel\Control\InputCheckBoxControl;

use FormModel\Control\InputFileControl;
use FormModel\Control\InputRadioControl;
use FormModel\Control\InputSubmitControl;
use FormModel\Control\InputTextControl;
use FormModel\Control\SelectControl;
use FormModel\Control\TextAreaControl;
use FormModel\FormModel;
use FormModel\Group\Group;
use FormModel\Validation\ControlsValidator\ControlsValidator;
use FormModel\Validation\ControlTest\WithFields\MinCharControlTest;
use FormModel\Validation\ControlTest\WithFields\RequiredControlTest;


$formModel = FormModel::create()
    ->setFormErrorPosition('central')
    ->setDisplayFirstErrorOnly(false)
    ->setOrder([
        'groupTwo',
        'groupOne',
        'submit',
    ])
    ->addGroup("groupOne", Group::create()
        ->label("About you")
        ->children([
            'name',
            'age',
        ])
    )
    ->addGroup("groupTwo", Group::create()
        ->label("About your favorite sports")
        ->children([
            'favorite_sports',
            'favorite_color',
            'country',
            'groupThree',
        ])
    )
    ->addGroup("groupThree", Group::create()
        ->label("Some other fields")
        ->children([
            'towns',
            'message',
            'avatar',
        ])
    )
    ->addControl("name", InputTextControl::create()
        ->placeholder("Type your name")
        ->hint("Your name is used to identify you")
        ->label("Name")
        ->name("name")
    )
    ->addControl("age", InputTextControl::create()
        ->value(38)
        ->label("Age")
        ->name("age")
    )
    ->addControl("favorite_sports", InputCheckBoxControl::create()
        ->setItems([
            'karate' => "Karaté",
            'judo' => "Judo",
            'kungfu' => "Kung Fu",
        ])
        ->label("What's your favorite sport?")
        ->name("favorite_sports[]")
        ->value(["karate", "judo"])
    )
    ->addControl("favorite_color", InputRadioControl::create()
        ->setItems([
            'red' => "Red",
            'blue' => "Blue",
            'green' => "Green",
        ])
        ->label("What's your favorite color?")
        ->name("favorite_color")
        ->value("red")
    )
    ->addControl("country", SelectControl::create()
        ->value("spain")
        ->setItems([
            'france' => "France",
            'spain' => "Spain",
            'italy' => "Italy",
        ])
        ->label("Country")
        ->name("country")
    )
    ->addControl("towns", SelectControl::create()
        ->multiple()
        ->setItems([
            'chartres' => "Chartres",
            'tours' => "Tours",
            'orleans' => "Orléans",
        ])
        ->label("Towns you've lived in")
        ->name("towns[]")
        ->value(["chartres", "tours"])
    )
    ->addControl("message", TextAreaControl::create()
        ->label("What's your message")
        ->name("message")
        ->value("")
    )
    ->addControl("avatar", InputFileControl::create()
        ->label("Avatar")
        ->name("avatar")
    )
    ->addControl("submit", InputSubmitControl::create()
        ->name("form_posted")
        ->addHtmlAttribute("value", "Send")
    );


$values = [
    "name" => "iii",
    "favorite_sports" => [
        'karate',
        'kungfu',
    ],
    "favorite_color" => "green",
    "towns" => [
        'chartres',
    ],
];
$values = $_POST;


$formModel->inject($values);


$validator = ControlsValidator::create()
    ->setTests("message", "Message", RequiredControlTest::create());

$validator = ControlsValidator::create()
    ->setTests("message", "Message", [
        RequiredControlTest::create(),
        MinCharControlTest::create()->min(4),
    ]);


$formModel->setValidator($validator);
a($formModel->validate($values));


$formConf = $formModel->getArray();


// 168 lines
$formConf2 = [
    'form' => [
        'htmlAttributes' => [
            'action' => "",
            'method' => "POST",
        ],
        "formErrorPosition" => "control",
        "displayFirstErrorOnly" => true,
    ],
    'order' => [
        'groupTwo',
        'groupOne',
        'submit',
    ],
    'groups' => [
        'groupOne' => [
            'label' => "About you",
            'children' => [
                'name',
                'age',
            ],
        ],
        'groupTwo' => [
            'label' => "About your favorite sports",
            'children' => [
                'favorite_sports',
                'favorite_color',
                'country',
                'groupThree',
            ],
        ],
        'groupThree' => [
            'label' => "Some other fields",
            'children' => [
                'towns',
                'message',
                'avatar',
            ],
        ],
    ],
    'controls' => [
        "name" => [
            'label' => 'Name',
            'type' => 'input',
            'htmlAttributes' => [
                'name' => 'name',
                'type' => 'text',
                'value' => '',
                'placeholder' => 'Type your name',
            ],
            'hint' => 'Your name is used to identify you',
            /**
             *
             * A setting at the widget level determines whether or not only the first error message should be
             * displayed, or all error messages.
             * Also, there will be some "trick" to grab all error messages and display them in a centralized place
             * rather than on a per control basis, also depending on a widget level setting.
             *
             */
            'errors' => [
                "The name must contain at least 5 chars",
                "The name must not be empty",
            ],
        ],
        "age" => [
            'type' => 'input',
            'label' => 'Age',
            'htmlAttributes' => [
                'name' => 'age',
                'type' => 'text',
                'value' => '38',
            ],
            'errors' => [],
        ],
        "favorite_sports" => [
            'type' => 'input',
            'labelLeftSide' => false,
            'label' => "What's your favorite sport?",
            'htmlAttributes' => [
                'name' => 'favorite_sports[]',
                'type' => 'checkbox',
            ],
            'value' => ["karate", "judo"],
            'items' => [
                'karate' => "Karaté",
                'judo' => "Judo",
                'kungfu' => "Kung Fu",
            ],
            'errors' => [],
        ],
        "favorite_color" => [
            'type' => 'input',
            'labelLeftSide' => false,
            'label' => "What's your favorite color?",
            'htmlAttributes' => [
                'name' => 'favorite_color',
                'type' => 'radio',
            ],
            'value' => "red",
            'items' => [
                'red' => "Red",
                'blue' => "Blue",
                'green' => "Green",
            ],
            'errors' => [],
        ],
        "country" => [
            'type' => 'select',
            'label' => "Country",
            'htmlAttributes' => [
                "name" => "country",
            ],
            'value' => "spain",
            'items' => [
                'france' => "France",
                'spain' => "Spain",
                'italy' => "Italy",
            ],
            'errors' => [],
        ],
        "towns" => [
            'type' => 'select',
            'label' => "Towns you've lived in",
            'htmlAttributes' => [
                "name" => "towns[]",
                "multiple",
            ],
            'value' => ["chartres", "tours"],
            'items' => [
                'chartres' => "Chartres",
                'tours' => "Tours",
                'orleans' => "Orléans",
            ],
            'errors' => [],
        ],
        "message" => [
            'type' => 'textarea',
            'label' => "What's your message",
            'htmlAttributes' => [
                "name" => "message",
            ],
            'value' => "Hello",
            'errors' => [],
        ],
        "avatar" => [
            'type' => 'input',
            'label' => 'Avatar',
            'htmlAttributes' => [
                'name' => 'avatar',
                'type' => 'file',
            ],
            'errors' => [],
        ],
        "submit" => [
            'type' => 'input',
            'htmlAttributes' => [
                'name' => 'form_posted',
                'type' => 'submit',
                'value' => 'Send',
            ],
        ],
    ],
];


$conf = [
    "layout" => [
        "name" => "splash/default",
    ],
    "widgets" => [
        "main.form" => [
            "name" => "form/default",
            "conf" => $formConf,
        ],
    ],
];

