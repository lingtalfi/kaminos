<?php


namespace ApplicationItemManager;


interface ApplicationItemManagerInterface
{

    /**
     * Import an item and its dependencies in the import directory.
     * If force is false, will not try to replace already imported items.
     * If force is true, will remove an already imported item before importing it.
     *
     */
    public function import($item, $force = false);

    public function install($item, $force = false);

    public function uninstall($item);


}