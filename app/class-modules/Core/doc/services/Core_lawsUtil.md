Core_lawsUtil
==================
2017-04-25




Provides an instance of the LawsUtil utility.

You generally want to use this LawsUtil instance across your controllers, for (laws rendering) consistency;
unless you have a good reason not to do so.


The service itself calls a hook (Core_addLawsUtilProxyDecorators) so that modules
can bind decorators to the LawsLayoutProxy object attached to LawsUtil instance.
 
 
By the way, the Core module uses the Core_addLawsUtilProxyDecorators hook (see related documentation 
for more info). 