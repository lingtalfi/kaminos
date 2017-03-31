<?php


namespace ApplicationItemManager\Importer;


interface ImporterInterface
{
    /**
     * force: if true, will remove the possibly already existing item before importing
     */
    public function import($item, $importDirectory, $force = false);

}