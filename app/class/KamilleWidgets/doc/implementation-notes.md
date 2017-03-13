KamilleWidgets implementation notes
======================================
2017-03-13





Form
===============
2017-03-13

The basic idea is that a template contains all the necessary information to display the controls.
Some users will have advanced needs in terms of controls.
Let's say it upfront: it is not expected that all templates can handle all controls; rather, a template
is adapted to the user needs.

Most templates should handle basic/common controls like input, select, textarea,...

Then we have the variables modelization.

Before we use fancy methods/objects to create a representation of the form, let's remember that ultimately
a widget only understands variables, and it is my will to use an array form, since I believe it's the lowest level,
most flexible and agnostic form of variables.

The main idea is to ultimately pass this kind of array to the setVariables method of the widget:


```php 

$vars = [
    'controls' => [
        [
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
            'errors' => [],
        ],
    ],
];
```
 
As you can guess, there is a "controls" property which holds all the controls.
Each control being an array itself.

I forgot to say, but the goal of the widget is to RENDER a form; not to handle the errors or to handle the submission
of the form, it's just about visual rendering.

In other words, a widget is dumb, it just displays what it is told to.
So, if there is an error, it displays it, otherwise it doesn't, but it does NEVER take the initiative of creating an error.


Now the template authors might need some convention about the "type" property of a given control.
 
In the above example, I used type=input. As you can guess, it's representing the input control.
Basically, the type is the html tag, at least for common controls.

If you have super controls which do not refer to a particular tag, you can still use the "type" property,
but you will have to create your own names.



Controls
----------
So that being said, here are the available properties available for a given control:
 
 
- type: the type of the control. For common controls, it's the name of the html tag
- htmlAttributes: html attributes to add to the control (which might/might not be a common html control)
- hint: a message to display to help the user filling the control correctly
- errors: an array of errors relating to this control. Note, the displaying of how many errors to display,
                and where to display them is decided elsewhere, but the errors property of the control
                is the only place where errors related to this control should be
- ...: might be more coming


Form
---------
 

