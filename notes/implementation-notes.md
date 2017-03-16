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

I have a very basic idea of what a module system should be, here are some features I want:

- ability to import modules with a one line terminal command
- A module class with two methods: install, uninstall


The idea of installing and uninstalling encompasses the databases/tables installation (if necessary), or/and the
files, and maybe other things I didn't think of yet.

So actually, those are two totally different ideas, which deserve proper conception each.

The two ideas are:

- a repository/system which lists all modules, and permits access to them. My import idea should be bound to this system.
- then the next idea is the idea of the life cycle of a module within an application.
    The install/uninstall methods are related to this area.
    But also arises a new question: who (which object) is responsible for triggering the 
    module install/uninstall methods?
    
    
So, all those problems to solve.
    
Let's start by the module within the application.
    
    
    
A Module within an application
---------------------------------

Assuming that calling a given module's install/uninstall method will take care of all the details of 
installing/uninstalling a module, the question remains: who is responsible for calling the triggering of 
those precious methods?
 
I don't want to parasite the Application with the notion of modules, as not all applications might need modules.
  
However, a first simple idea is to list all modules as a parameter of the application 
(like theme for themable applications).
  
However, let's keep in mind that modules will be installed/uninstalled, and we should be able to keep track
of the installed module list at any time (because some modules might depend on other modules, so this information
could be useful in this case).

Rather than risking to update the userland index file, we could create a module.txt file at the application root level,
which would contain the list of modules actually installed.
 
This would give us at least two things:

- we can simply open that file to see which modules are/aren't installed
- it feels safer to update an isolated text file rather than an userland index file

But that's just the how, it doesn't affect the WHERE question, which still remains unanswered (and the goal of this
section by the way).

So: where?

Does it make more sense to have the list of modules as an application parameters, or to have some kind of 
dedicated ModulesList object responsible for that?










    
    
    
    
    
    
    
    
    
    
    
    



