exceptionController
============
2017-04-28







This controller displays a page showing an "exception" page, using a [laws](https://github.com/lingtalfi/laws) view.
The laws view uses the [Exeption widget](https://github.com/KamilleWidgets/Exception).


It's the default controller used when an exception is caught at the WebApplicationHandler level.

(The WebApplicationHandler is THE object responsible for handling any application request
in a standard kamille app, you can find it right inside the index.php).


The WebApplicationHandler creates an earlyRouter, which is executed before the other routers,
and binds the ExceptionRouter to it.

The ExceptionRouter checks whether or not an exception has been caught at 
the WebApplicationHandler level (see implementation
details in WebApplicationHandler), and if this is the case, it renders a page using the 
controller defined by the Core.exceptionController option, which by default uses this
exceptionController.





