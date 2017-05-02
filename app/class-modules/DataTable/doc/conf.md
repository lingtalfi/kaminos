Configuration
===============
2017-05-02


uriAjaxHandler
-----------------
Default: Controller\DataTable\DataTableController:handleAjax

The uri to the ajax handler, which by default calls the DataTableController provided by this module.



uriAjaxActionsHandler
-----------------
Default: DataTable\AppDataTableController:handleAjaxAction

The uri to the ajax handler responsible for handling special links.
With the default renderer, special links are triggered when the user does one of the following:

- click on an action button
- click on a special link (inside a row)
- selects a bulk action

In other words, those uri are the extra uri required for implementing special user defined actions.

By default, it's assumed that the user provides her own Controller: DataTable\AppDataTableController:handleAjaxAction
(app/class/DataTable/AppDataTableController.php).



