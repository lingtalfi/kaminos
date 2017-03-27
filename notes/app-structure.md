Kaminos app structure
========================
2017-03-24



Kaminos uses the following tree structure.



```txt
- app
----- class: contains the userland classes
----- class-controllers: contains the user's controllers
----- class-core: contains the kaminos core classes
----- class-modules: contains the modules
----- config: contains the application configuration files
----- functions: contains the application function files
----- logs: contains the application log files
----- pages: directory containing pages used by the StaticPageController (if your application uses this controller)
----- planets: directory for the planets from the universe framework
----- theme: directory containing the files related to the theme (kaminos is a themable application), except for web assets which must be in the www directory
----- vendors: directory for the planets from the composer framework
----- www: the root of the web server; it contains all the web assets
----- boot.php: boot the application environment
----- init.php: configure the application instance
----- modules.txt: file owned by the kamille program, which installs/uninstalls the kaminos modules. This file contains the list of installed modules by the way.



```
