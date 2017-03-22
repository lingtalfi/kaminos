


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
  
2017-03-17
I thought about it yesterday, here is how I'm going to implement it.
  
There is an ApplicationHost object, which role is to help modules install themselves into the application.
Let me recap all this.
 
So far, we've discussed the internal of the alive application: how a request enters an application and is treated 
by the application.
The application is like an alive organism, with lot of activity inside of it.
 
I like to picture the installation as a parallel process.
The installation of the picture doesn't require the application to be alive to operate; that is, if the application
had a power off button, we could still install modules while the application is off.

In terms of practical code, this means we won't need access to the application instance to install modules.

It's important to get this metaphor right.

Although you can install modules on an alive application if necessary, the installation of modules in itself is 
a parallel process that can be done at any time.


ApplicationHost - Super services
-----------------------------------

The first idea I had was the idea that modules should be able to know the architecture of the application they
would be injected into.
So, one might say that using conventions is the way to go.
Well, maybe, but my idea was that the modules would communicate with the "application brain" (application host),
which role would be to basically answer any question the module have about the application structure.

So basically, the following synopsis occurs during a module installation.

The module comes into the application zone:

The module is coming, and the application host sees it..

- appHost: Hi module, you want to get installed? come here, please state your name and install yourself
- module: hey application host, thanks, my name is Roger. I will install myself. Btw, where is your pdf template directory?
- appHost: it's here: /app/pdf
- module: ... 
- module: ok, I'm installed now
- appHost: nice, I take note of that, have a good day Roger


Well, the benefits of using an applicationHost over simple conventions are (at least):

- first, the applicationHost can keep track of the installed modules
- second, the applicationHost can be re-used for any pluginishable thing (not only modules)
- third, if the application owner wants to change the path to the pdf (for whatever reason), she can, just by updating the applicationHost


So, I like this idea of ApplicationHost.
ApplicationHost would be a singleton, so that we can access the installed modules list at any moment.
In particular, this list might be needed during module installation (imagine a module who wants to install a dependency,
or a module which behaviour is affected by the presence of another module? --is that possible? dunno--). 
 
 
So, the ApplicationHost, as described so far, seems only to resolve the problems of application paths,
but what about the database password: how does a module install the mysql tables it needs if it doesn't have access
to the alive application?


Aha. That's starting to be interesting.
The question is: where are the database passwords? (and is this information accessible to modules?)

Remember that we created an X container earlier? X is a static service container.
In other words every service it contains is accessible via a public static method.

Well, that container is somehow the key of delivering the passwords to the modules.

My idea was simply to agree on a set of super services (a super service being a COMMON service as opposed as
a service created for a module in specific) that an application would have, and make those super services
extend a SuperService class, which would have a (if technically possible) getConfiguration public static method.

This getConfiguration method would return an array of per-service defined parameters, and the goal of this method
would be to help with the installation of modules.
Some super services maybe won't have any particular configuration. But at least for the database and the logger,
this idea might be interesting.

What I love with this idea is that it gives a true reason to live for the static service container.

In kam, the choice of using a static service container was evoked as an experimental idea against a traditional 
per-application service container.
The main idea being to encapsulate parameters inside the service itself rather than having a centralized parameters pool. 


Basically, by making this decision of encapsulating parameters with their services, the services become static and alive
by themselves: they live by themselves: we have full-featured standalone services.

So, now we can grab the fruit from this idea with modules installation.
Modules can simply ask those special services (services with a getConfiguration method) their configuration at any moment,
in parallel of the application life.

But this makes me think of one thing: the app_dir, as for now is only available as the application is instantiated.
What if modules need this value, or other values set as application params?

Well, the simple answer would be to create a super service that would contain the application parameters.

Basically, I'm saying: first there were the super services, and then, the application came.

(ApplicationConfigurationService could be its name).

So, all the talk above is just ideas: it needs to be implemented.
Let me do the implementation, it will make things cleaner.
