Authenticate
================
2017-04-10 --> 2017-04-21




This module brings the [authenticate system](https://github.com/lingtalfi/Authenticate) to your kamille application.


It provides various things:

- an authentication form, to authenticate users 
- the Authenticate_grantor service (A::has), to check whether a connected user has or hasn't a role



It basically provides hooks for other modules to tap into the authenticate system (bring their own profile and badges,
or even users).



Routing
==============
The Authenticate module provides by default the AuthenticateRouter router.
This router checks whether or not the user is connected.

If the user is not connected, the router calls the AuthenticateController, which basically
handles the authentication form and connects the user in case of successful authentication.


The router also listen for the disconnect key in the $_GET parameters.
If found, the router will disconnect the connected user and redirect her to the same uri she was (with the disconnect
key removed though).




Widgets
===========
- https://github.com/KamilleWidgets/Notification
- https://github.com/KamilleWidgets/LoginForm


Configuration
================

See comments in the conf file.






Services
================
- Authenticate_userStore: access the user store instance, check the authenticate system doc for more info
- Authenticate_badgeStore: access the badge store instance, check the authenticate system doc for more info
- Authenticate_grantor: access the grantor instance, check the authenticate system doc for more info
                    This has method of this service is also provided via the shortcut A::has() for developers convenience


By default, the user store and the badge store both uses file based stores.
The stores are located in app/store/Authenticate/profiles.php and app/store/Authenticate/users.php 