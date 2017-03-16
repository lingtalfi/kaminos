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







 
 
 
 
 
 
 
 
 

