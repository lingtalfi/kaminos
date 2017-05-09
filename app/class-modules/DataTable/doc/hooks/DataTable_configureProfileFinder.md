DataTable_configureProfileFinder
==================================
2017-05-09


This hook allows you to configure the DataTableProfileFinder instance,
which is used to find the datatable profile file based on a datatable profileId.

It was made so that you can add fallback handlers to this instance.
The AutoAdmin module makes use of that.
