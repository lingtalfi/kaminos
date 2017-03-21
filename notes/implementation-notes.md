Implementation notes
========================
2017-03-15




Request - Controller - Template 
====================================
2017-03-15


I had many questions related to the relation between Request, Controller and Response.

- can a given Request be handled by different Controllers?
- can a Controller display different views?



Here are my thoughts about it and how I will personally implement those kind of things in kaminos:

- although a Request can have variable parameters, a given Request should always be handled by the same 
Controller (at least I couldn't think of a system that would benefit having multiple possible Controllers for 
a given Request, maybe I'm wrong)

- once a Controller is chosen, it can choose which layout (template) to call. 
        And that layout can also be changed with the theme.
        
        For instance, if a form post is successful, a controller can decide to display layoutOne (which shows a success message),
        but if the same form post (same request but different data) is a failure, the controller might decide to display
        layoutTwo, which shows the form.
        
        



A picture of a themable application
------------------------------------


So we use a themable application: an application which defines a theme parameter used by all other objects beyond.

When the request enters the router, a controller will be chosen.
 
Imagine we have two pages: an e-commerce product page: /kettle-bell, and a login form page: /login.


So the user accesses /kettle-bell via her browser.
 
The router request listener dispatches the request to its own internal loop, and a router matches the /kettle-bell
uri with a product controller, and productId=654 (i.e. kettle-bell=654 in an imaginary database).

The product controller will fetch the info corresponding to product id=654 and pass those info to the product layout,
which will display those info.


Now for the /login page.

So the user accesses the /login uri via her browser.

A router will match /login with the displayForm controller. The displayForm controller will simply call the form layout,
without passing any particular data to it.

But now, the user posts the form.
The requested page could be different than /login, or it could be /login as well.

Let's see both cases.
First, if /login is called.

This time, the router will match /login, but will also detect that some $_POST parameters exist,
and therefore will choose the handleForm controller.

The handleForm controller will treat the data, probably updating the state of the database, and then call 
a layout. In the case of a form, it makes sense to call the same layout than the one that was used to display the form 
in the first place, especially if there was a form error, so that we can emulate form data persistence (i.e. the data
written by the user are still written in the form).

So, the handleForm controller will call the form layout (same as the displayForm controller).
Note: we can display a different layout in case of success if we want to. Which means that the same controller can
decide which layout to use, depending on the request (or user data).


Now, if another page was called, for instance /form-success.

Then the router would match a displayFormSuccess controller, which in turn would call a displayFormSuccess layout, just
basic chain here.


So, as page creators, we need some kind of visual representation of all this.
Below, I will draw what I have in mind about this topic. If you have a better representation, please share.
Hope this helps.


[![themable-application.jpg](https://s19.postimg.org/knkaa5u1v/themable_application.jpg)](https://postimg.org/image/4pbkk0ztr/)


As you can see on the image, we have some flexibility: for the /login uri, we can make choice at two different levels:
at the router level (choosing the controller), or at the controller level (choosing the layout), or even both if we needed to.

Although I prefer the idea of making this choice as early as possible (at the router level), I would personally 
implement this at the controller level, because I know that in most cases I will want to use the same url throughout 
the whole form process (from displaying the form to displaying the form success message), plus, it makes it easier
on the router to redirect every /login traffic to the FormController (and I didn't create the appropriate routers to handle
such a request right now...).

On the other hand, making the choice at the router level would allow to re-use a common success form page across multiple
controllers, for instance.


However, this points out that the router needs all kind of information, including $_POST variables for instance,
to make a controller choice, which explains a bit (at least for me) why some other frameworks attach those $_POST variables
to the request object. In my case, as I said, I prefer to use the native php arrays (to not reinvent the php wheel).


 
Kaminos implementation notes
=================================
2017-03-16
 
 
Now I thought it would be interesting to write down some of my notes while implementing the kaminos system.
I want to start by implementing the admin theme, I chose [gentelella](https://colorlib.com/polygon/gentelella/index.html) 
since it seems to me to have all the necessary whistles and bells that an admin user would ever 
need (and also, perhaps mostly, it's free).
 
 
So kaminos comes from kamille and nullos admin (my previous admin system, which unfortunately wasn't mvc).

Basically, kaminos is nullos with mvc.

For now, I just have the home page and a login page working (I mean, just displayed, no logic is working behind),
just to test the fresh new kamille router-controller-response system.

Now my goal is to implement the login page for real.
However, I want it as a module.

Okay, the only problem is that I don't have a module system yet.

So let's first do a module system.


Module System
===============

What's a module?

A module is a piece of code, possibly spread across multiple files, which modifies the behavior of an application.
Once installed, it's part of the code of the application.
A module has no limitation: it can do all an application do, and even more. 
Then to remove the functionality brought by a module, one need to uninstall that module.



To install a module, you need to import it first.

To import a module, you copy paste its directory into the class-modules directory of the app, done.
Once imported in your app, you can install a module by calling its module installer's install method (and uninstall the
module by calling it's module installer uninstall method).

The installation of a module is a separate process that can be done even if the application is off
(but you can do hot installation on an alive application instance if you want too).




Application parameters should be available at any time (not only when the application is instantiated).
That's because modules will need them (app_root_dir, admin root dir, other things...).

So I thought of this a bit.

Here is the new architecture, including the modules in the picture.


At the beginning there is nothing.

First we will create the application environment, and then we will instantiate and launch the application.

# Application environment

The application environment is the environment in which the application can be instantiated and launched. 

The first thing you do is to define the application parameters (ApplicationParameters).
Then, the X service container is there. You've got nothing special to do, as it's already there as part of the environment.
Note that the X container services are mainly services injected (statically) by modules.
 
Once you have the ApplicationParameters set and the X container ready, then you've got what's called the Application environment.


# Application launch

So now the application environment is set.
We can safely instantiate and launch the application.

In a web application, we do this from the index.php file.
The code inside the index file instantiate the web application and starts listening to the request.




The picture below might help understanding this.


[![kaminos-modular-architecture.jpg](https://s19.postimg.org/f722z5hlv/kaminos_modular_architecture.jpg)](https://postimg.org/image/q6naar80v/)



X 
===========
2017-03-20

In kam, there is the idea of providing static services, which allows the developer to use auto-completion
by auto-recognition of the hint (thanks to the ide).

I went trough the pros and cons again, and basically, I now prefer to have a common get method.
Let's see why.


Pros of having a container with direct access to static services:
- auto-completion
- (and therefore) faster development

Cons:
- the services are dispatched


Pros of having a centralized get method:
- one method only (simpler)
- no hard (php) dependencies 

Cons:
- (negligeable?) loss of performance



Trying to create a module system, my biggest concern is to have a simple/comprehensible model to work with.
Since modules bring most of the functionality of an application, the new conception of X is remodeled to work with them.


So basically, what makes me change my mind is that despite both technique create dependencies to "modules",
the one with the centralized get method allows us to encapsulate the dependencies error.
 
The problem I had with the non centralized model is that I couldn't get around the php limitation: if the class
and method you call is not there: it will create a php error. Maybe you can catch it somehow and convert it to an 
exception, but it might require to change the php ini settings, and THAT makes it impossible for me to accept,
as I don't want to force any php setting.

So I had to found another solution, and here it is: X.





The basic idea: to install and uninstall modules
---------------------

The main idea is this:
when you install a module: it becomes available, when you uninstall a module: it becomes unavailable.
In terms of code, this means that the services also become available/unavailable as the modules are installed/uninstalled.


Then there is the idea of two objects:

- XConfig
- XServices



XConfig holds the parameters of the modules.
It has a main get static method, which allows access to the configuration of all modules.
XConfig is fed/unfed as the modules are installed/uninstalled.

It allows the implementation of retrieving parameters one by one.
 
Then there is XServices, which is also fed by modules, and also contains a get centralized method (so that we can 
encapsulate unavailability errors).
 
 
In terms of implementation, I thought about a system which would allow:
 
- creation of parameters using a simple php? parameter file, the benefit being that this would be centralized, 
        and so easier to develop/maintain for the author.
        
- creation of services using an internal (in the module package) Service class, which services get exported automatically
        when the module is installed.
        
        
The second main idea is this: modules communication passes via services.
This idea ensures that there will not be hard dependencies; all dependencies are controlled because they pass via
services.




Then there is the concept of being agnostic.
I generally like this concept.

But implementing X (XServices and XConfig), I need at least a verbal justification.

Even if I did a container instance implementing a container interface, I would need to create an interface,
so, having an interface let us have more choice than using X, but in the end, we still have to use a container.


But then, if you think about it again, you don't have to use those, it's just one suggestion (that I will be using
all the time, but still). So, you could create a totally different system if you wanted to.
But related to modules, X is the proposed default implementation, so this is a bold, non agnostic choice,
a step in a direction trying to make things happen.


Ethically, the question can be put in a simplest form: does an application need to use a service container?
Or, is a service container more like a singleton service, always available, and used by convention?
        
This question has been already answered in the kaminos modular architecture schema (https://s19.postimg.org/f722z5hlv/kaminos_modular_architecture.jpg):
the container exists BEFORE the application is even instantiated.


In fact, the XConfig object can be thought as a helper for the XServices container, and 
thus the kaminos modular architecture schema is still accurate.
 
 
 
So, in my kaminos implementation, the main "line" will be XServices and XConfig.





Install module
===================
2017-03-21


The install module process in kaminos uses the UserError system (an UserErrorException is thrown to signal
an error to the user).

This means that modules installation can throw UserErrorException to signal something to the user.




Boot - Init: two complementary scripts
=========================================
2017-03-21


While working in the kamille moduleInstaller script, I had this error where the module complained about
a class being not loaded.
Right, I forgot to autoload the classes. But how to autoload them properly?

I was wondering how to boot the target application.
 
Starting from the kaminos modular architecture schema again, we see that a kaminos app is split in two parts:
the application environment, and then the application instance.

The init.php file, that I was used to ship with any application was just not enough anymore. 

Then I figured that a file per "part" would do the trick: a boot.php file would prepare the application environment
part, while the init.php file will be re-allocated/dedicated to only the application instance part, which makes 
even more sense to me.

The benefit of this is that now my module installer script can call the boot.php script without worrying about 
accidentally including some init.php code.


The boot script's role is to setup the application environment.
The application environment is all modules need to install/uninstall themselves.

So, I could update my schema now and annotate each "part" with the corresponding script. 
But, I don't want to rush things.






 