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



ModuleInstaller: a service to install a module
--------------------------------------------------




