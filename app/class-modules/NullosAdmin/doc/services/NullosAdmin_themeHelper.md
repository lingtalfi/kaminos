NullosAdmin_themeHelper
========================
2017-04-23



If you are building widgets, you will probably need to load some libraries (some js files, and maybe some css files too).

This service helps you with calling libraries: it returns an instance of a theme helper object (app/class-modules/NullosAdmin/ThemeHelper/ThemeHelperInterface.php),
which has an **useLib** method.

The **useLib** method takes one parameter: the library to use.


You can/should use the **useLib** method to load a built-in library.
  
Built-in library are listed in the ThemeHelperInterface.