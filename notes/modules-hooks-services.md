Modules, services and hooks 
=============================
2017-03-26


In kamille, the relationship between modules, hooks and services is not very well defined,
and free to a lot of interpretation.


In kaminos, I've worked a lot on those relationships.
The new relationships are now clearly defined, which makes the whole system easier to understand.






- What's a module?
- What's a service?
- What's a hook?



Module
===============
A module can be thought as a directory containing an ensemble of objects which
brings functionality to the target application.

Modules are located in the class-modules directory of a (kaminos) application.


Modules have a lifecyle:

- a module is first imported into the target application
- then it must be installed in order to be visible to the application
- once installed, a module can be uninstalled
- once uninstall, it is safe to remove the module directory, and so the lifecycle of the module can start over again


The main idea is this: IN ORDER TO USE A MODULE IN YOUR APPLICATION, YOU NEED TO INSTALL IT.

This idea makes the system simple to understand: if a module is not installed, you will not be able to use its functionalities.

Now how do you access a module's functionality?

Through hooks and services only.
In other words, a module communicates with the outer world via the hooks and the services.


Note: this system (services and hooks) is the implementation consequence of the 
idea: IN ORDER TO USE A MODULE IN YOUR APPLICATION, YOU NEED TO INSTALL IT.



Services
============

A service can be thought as a function brought by a module.

All services are accessible via X, which is the service container in a kaminos application.
 
X contains all the services of installed modules.

In fact, when you install a module, this module binds its services to the X container,
and when you uninstall a module, the module unbinds its services from the X container.

That's why it is so important to uninstall a module before your remove its directory, otherwise you can end up
with services in the X container that belongs to a removed module (aka ghost services).
 
 
A service is the primary form of module intercommunication.
A module can provide any function to the outer world via the X container.

It is the most flexible mean modules have to expose their functionality to the outer world (other modules, and application code).


In terms of implementation of the idea that IN ORDER TO USE A MODULE IN YOUR APPLICATION, YOU NEED TO INSTALL IT,
all methods added by modules are of visibility protected, and you access them via a centralized get method,
which encapsulates the knowledge of whether a module is installed or not, and will refute access to a service
is a module is not installed(, and grant access to a service if the module is installed).


Hooks
=========

Modules have already services, so why do they need hooks?

A hook is a specialized form of a service.
You see, a service can do anything, but a hook is specialized in gathering information from other modules.

The best example of a hook I have is the following.

You want to create an ecommerce website, with lot of modules.
Then you start by creating a module which role is to display a left menu in the backoffice.

The thing is that you want other modules to feed the menu items.
In other words, you don't know the items in advance.

That's when you use a hook.

You will use a hook so that OTHER MODULES WILL BRING DATA to your menu.


In terms of implementation, this is also different from a service.

When a service is bound to the X container, a method is added to the X container.

Now with hooks, this is a slightly different.
There is a Hooks container, and when you install a module, one of the two things happen:

- if your module provides hooks, then its hook method(s) will be added to the Hooks container
- if your module subscribe to hooks, then the code of the subscriber is added INSIDE the hook method: 
                        it participates to the code of the hook method. 


So, this is a two way binding process, depending on whether your module acts as a hook provider, a hook subscriber,
or both.

A provider will add method to the Hooks container, whereas a subscriber will participate to write the internal code
of a method.


Like for services, Hooks are accessed through a centralized method: call, which encapsulates the idea that 
IN ORDER TO USE A MODULE IN YOUR APPLICATION, YOU NEED TO INSTALL IT.
So basically if you try to access a hook from a module which is not installed (or which has been uninstalled),
you will be rejected somehow (either an exception will be thrown, or you will get a default value,
depending on the arguments that you sent to the call method in the first place).






Conclusion
=============


So this concludes this part on modules, services and hooks.

Modules, services and hooks are part of the module land.
Services and hooks are how modules communicate with other modules and with the outer world.

Hopefully the picture of the whole system becomes clearer now.

The idea, "IN ORDER TO USE A MODULE IN YOUR APPLICATION, YOU NEED TO INSTALL IT"
is the foundation of this implementation.

It is a simple idea which makes the whole system more understandable.


































