<?php

namespace ApplicationItemManager\Installer;


interface InstallerInterface
{

    public function install($item);

    public function isInstalled($item);

    public function uninstall($item);

    public function getList();
}