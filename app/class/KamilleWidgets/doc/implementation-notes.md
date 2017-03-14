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
    'form' => [
        'htmlAttributes' => [],
    ],
    'controls' => [
        "myidentifier" => [
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

Note the key referencing the control array. In the example above, the "myidentifier" is used.
You could use the default numeric keys (implicitly set by php) if you wanted to, the only reason identifiers
are handy is when you want to have more control on the controls order (as we will see later).



Controls
----------
So that being said, here are the available properties available for a given control:
 
 
- type: string, the type of the control. For common controls, it's the name of the html tag
- label: string|null, the label of the control, defaults to the identifier if not set
- htmlAttributes: array, html attributes to add to the control (which might/might not be a common html control)
- hint: string|null, a message to display to help the user filling the control correctly
- errors: array, an array of errors relating to this control. Note, the displaying of how many errors to display,
                and where to display them is decided elsewhere, but the errors property of the control
                is the only place where errors related to this control should be
- ...: might be more coming


Note: for all controls, those properties defined above are mandatory.


Form
---------
Then there is the form tag to create.
As for the controls, we will use a property in an array: the form property.
This form entry will be an array with the following properties:

- htmlAttributes: the html attributes to set on the form


Order
----------
Although the controls property will hold the list of controls to display,
we also should be able to control the order in which those controls are displayed.
By default, if the order property is not an array, 
they will be displayed in the order they appear in the controls array.

However, in some cases it might be useful to have a separated list to control the order.
So, the order property will be used for that. 
Why we use a separated "order" property makes more sense when you're aware that we can group controls; that's the
topic of the next section.

Example using order:

```txt
- order:
----- identifier1:
----- identifier4:
----- identifier5:
```



Groups
----------
Do you recall the fieldset tag?

This tag allow us to visually group controls in a form, creating nice and clean sections.

The idea of a group is serves the same purpose.
However, we use groups instead of fieldsets, because fieldset is the name of a specific html tag,
while a group is just the semantical idea of grouping controls, it doesn't specify how controls
will be grouped together (fieldset, div, other things...).

You specify the groups one by one in an array held by the "groups" property, like the following for instance:

```txt
- groups:
----- identifier1:
--------- identifier2
--------- identifier3
----- identifier4:
--------- identifier7
--------- identifier8
----- identifier8
--------- identifier9
--------- identifier10
```

Note: recursion is allowed, as in the example above (identifier 8 is a nested group)


Error displaying
----------------

There are different ways we can display form errors.
The following questions can help us:

- do we display the control errors at the top (or bottom) of the form, or do we display
        a control error at a control level?

- do we display all the errors at once, or one by one? At the form level, and control level?

      
Those two questions will give us the following variables:

- formErrorPosition: (control|central)=control
- displayFirstErrorOnly: bool=false




Form messages
--------------

Sometimes, errors are not related to any control in particular.
For instance: there is a problem with the database, the form could'nt be saved.

In general, we should be able to display some messages in the form, like success messages
(the item has been successfully recorded in the databse), or warning messages.

All messages are stored in the messages property, which contains an array of messages to display.
Each item of the array is an array with two entries: the message, and the message type (success, warning, info, error).
Generally, we will use only one entry, but I prefer to anticipate the fact that one day someone will
need to display more than one message.

Here is how it looks like:

```txt
- messages:
----- [ The data was successfully recorded in the database, success ],
----- [ I sent an email to the administrator too (as per config.sendMailToAdmin), info ],

```







