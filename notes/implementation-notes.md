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

- once a Controller is chosen, it will only call one layout (template), which could change with the theme



Controller states
---------------------

My image for making those decisions was the following: a page with a login form, with a link to a signup form,
but the link is just a javascript trigger that slides from the login form to the signup form (i.e., there is
only one html page).

After thinking about this example, I found out that in this case there was three different types of request:
- the request to display the form(s)
- the request to log in the user (create the session vars), which has two possible outcomes (either a success or a failure)
- the request to create a new user account, which returns either a success response, or an error response (maybe different possible error messages)

So, in this case, I will say that there are three controllers, one per request.

Although we can change the template and the theme, at the application level I believe that each controller should return
the same type of response, which I call states.
 
For instance, the request to display the form(s) will display a form (we can change the template or the theme, but it has
to display the signin/signup form), so this is only one possible state for the controller.
 
 
 
Now for the request to log in the user, the parameters will probably be passed via $_POST, but the controller output
can be either a success message, or an error message, so one state per type of response: success or failure (which might have
different variations, but basically use the same template). 
 




