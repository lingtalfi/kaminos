<?php


namespace ApplicationItemManager;


use ApplicationItemManager\Exception\ApplicationItemManagerException;
use ApplicationItemManager\Importer\ImporterInterface;
use ApplicationItemManager\Installer\InstallerInterface;
use ApplicationItemManager\ItemList\RepositoryInterface;


/**
 * - item: (importerId.)itemName
 *          If importerId is omitted and a default importerId is set, then the default importerId is used.
 */
class ApplicationItemManager implements ApplicationItemManagerInterface
{
    /**
     * @var ImporterInterface[]
     *
     */
    protected $importers;

    /**
     * @var InstallerInterface
     */
    protected $installer;

    /**
     * @var RepositoryInterface[]
     */
    protected $itemLists;
    private $importDirectory;
    private $defaultImporter;


    public function __construct()
    {
        $this->importers = [];
        $this->itemLists = [];
    }


    public static function create()
    {
        return new static();
    }

    public function bindImporter($importerId, ImporterInterface $importer)
    {
        $this->importers[$importerId] = $importer;
        return $this;
    }

    public function setInstaller(InstallerInterface $installer)
    {
        $this->installer = $installer;
        return $this;
    }

    public function addItemList(RepositoryInterface $itemList)
    {
        $this->itemLists[] = $itemList;
        return $this;
    }

    public function setImportDirectory($importDirectory)
    {
        $this->importDirectory = $importDirectory;
        return $this;
    }

    public function setDefaultImporter($defaultImporter)
    {
        $this->defaultImporter = $defaultImporter;
        return $this;
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    /**
     * Import an item and its dependencies in the import directory.
     * If force is false, will not try to replace already imported items.
     * If force is true, will remove an already imported item before importing it.
     *
     */
    public function import($item, $force = false)
    {
        $this->msg("preparingImportItem", $item);
        $item = $this->normalizeItem($item);
        $itemName = $this->getItemNameByItem($item);

        if (false === $force && true === $this->isImported($itemName)) {
            $this->msg("itemAlreadyImported", $item);
        } else {
            if (false !== ($importer = $this->findImporter($item))) {
                if (false !== ($itemList = $this->findItemList($item))) {
                    $tree = $itemList->getDependencyTree($item);
                    $this->msg("collectTree", $tree);
                    foreach ($tree as $treeItem) {
                        $treeItemName = $this->getItemNameByItem($treeItem);
                        if (false === $force && true === $this->isImported($treeItemName)) {
                            $this->msg("itemAlreadyImported", $treeItem);
                        } else {
                            $this->doImport($treeItem, $force);
                        }
                    }
                } else {
                    $this->msg("itemNotFoundInList", $item);
                }
            } else {
                $this->msg("importerNotFound", $item);
            }
        }
        return false;
    }


    public function install($item, $force = false)
    {

        $debug = true;


        $quiet = (false === $debug) ? true : false;
        $this->msg("preparingItemInstall", $item);
        $item = $this->normalizeItem($item);
        $itemName = $this->getItemNameByItem($item);

        if (true === $force || false === $this->installer->isInstalled($itemName)) {

            $itemsToInstall = [];
            if (false !== ($itemList = $this->findItemList($item))) {
                $tree = $itemList->getDependencyTree($item);
                $itemsToInstall = $tree;
                $this->msg("collectTree", $tree);
                foreach ($tree as $k => $treeItem) {
                    $treeItemName = $this->getItemNameByItem($treeItem);
                    if (false === $this->isImported($treeItemName)) {
                        if (false === $this->doImport($treeItem, $force, $quiet)) {
                            unset($itemsToInstall[$k]);
                            $this->msg("cannotImportItem", $treeItem);
                        }
                    }
                }
            } else { // useful for items that are not registered yet (i.e. local development)
                $itemsToInstall[] = $item;
                $this->msg("itemNotFoundInList", $item);
            }


            // ath this point, all items are imported, we install non installed items
            foreach ($itemsToInstall as $itemToInstall) {
                $itemName = $this->getItemNameByItem($itemToInstall);
                if (false === $force && true === $this->installer->isInstalled($itemName)) {
                    $this->msg("alreadyInstalled", $itemToInstall);
                } elseif (true === $force || false === $this->installer->isInstalled($itemName)) {
                    $this->msg("installingItem", $itemToInstall);
                    $this->installer->install($itemName, $force);
                    $this->msg("itemInstalled", $itemToInstall);
                }
            }
        } else {
            $this->msg("alreadyInstalled", $item);
        }
        return false;
    }


    public function uninstall($item)
    {
        $this->msg("preparingItemUninstall", $item);
        $item = $this->normalizeItem($item);
        $itemName = $this->getItemNameByItem($item);
        if (false === $this->installer->isInstalled($itemName)) {
            $this->msg("alreadyUninstalled", $item);
        } else {
            $itemsToUninstall = [];
            if (false !== ($itemList = $this->findItemList($item))) {
                $tree = $itemList->getHardDependencyTree($item);
                $itemsToUninstall = $tree;
            } else { // useful for items that are not registered yet (i.e. local development)
                $itemsToUninstall[] = $item;
                $this->msg("itemNotFoundInList", $item);
            }
            $this->msg("collectHardTree", $itemsToUninstall);

            foreach ($itemsToUninstall as $itemToUninstall) {
                $itemName = $this->getItemNameByItem($itemToUninstall);
                if (false === $this->installer->isInstalled($itemName)) {
                    $this->msg("alreadyUninstalled", $itemToUninstall);
                } else {
                    $this->msg("uninstallingItem", $itemToUninstall);
                    $this->installer->uninstall($itemName);
                    $this->msg("itemUninstalled", $itemToUninstall);
                }
            }
        }
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    protected function doImport($item, $force = false, $quiet = false)
    {
        if (false !== ($importer = $this->findImporter($item))) {
            $itemName = $this->getItemNameByItem($item);
            $this->msg("importingItem", $item);
            $importer->import($itemName, $this->importDirectory, $force);
            if (false === $quiet) {
                $this->msg("itemImported", $item);
            }
            return true;
        } else {
            $this->msg("importerNotFound", $item);
        }
        return false;
    }

    /**
     * @return ImporterInterface|false
     */
    protected function findImporter($item)
    {
        $importerId = $this->getImporterIdByItem($item);
        if (array_key_exists($importerId, $this->importers)) {
            return $this->importers[$importerId];
        }
        return false;
    }


    protected function isImported($itemName)
    {
        $itemDir = $this->importDirectory . "/$itemName";
        return (is_dir($itemDir));
    }

    /**
     * @return RepositoryInterface|false
     */
    protected function findItemList($item)
    {
        foreach ($this->itemLists as $itemList) {
            if (true === $itemList->has($item)) {
                return $itemList;
            }
        }
        return false;
    }


    protected function msg($type, $param = null)
    {
        $msg = "";
        $level = "info";
        switch ($type) {
            case 'preparingImportItem':
                $msg = "Preparing import for item $param";
                $level = "info";
                break;
            case 'importingItem':
                $msg = "Importing item $param";
                $level = "info";
                break;
            case 'importerNotFound':
                $msg = "No importer was found for item $param";
                $level = "error";
                break;
            case 'itemNotFoundInList':
                $msg = "Item not found in any list: $param";
                $level = "error";
                break;
            case 'itemAlreadyImported':
                $msg = "$param: Item already imported";
                $level = "info";
                break;
            case 'itemImported':
                $msg = "$param: Item imported";
                $level = "success";
                break;
            case 'cannotImportItem':
                $msg = "$param: Could not import this item";
                $level = "error";
                break;
            case 'collectTree':
                $msg = "Collecting dependencies: " . implode(', ', $param);
                $level = "info";
                break;
            case 'collectHardTree':
                $msg = "Collecting hard dependencies: " . implode(', ', $param);
                $level = "info";
                break;
            case 'preparingItemInstall':
                $msg = "Preparing installation for item $param";
                $level = "info";
                break;
            case 'installingItem':
                $msg = "Installing item $param";
                $level = "info";
                break;
            case 'alreadyInstalled':
                $msg = "$param: Item already installed";
                $level = "info";
                break;
            case 'itemInstalled':
                $msg = "$param: Item installed";
                $level = "success";
                break;
            case 'preparingItemUninstall':
                $msg = "Preparing un-installation for item $param";
                $level = "success";
                break;
            case 'alreadyUninstalled':
                $msg = "$param: Item already uninstalled";
                $level = "info";
                break;
            case 'uninstallingItem':
                $msg = "Uninstalling item $param";
                $level = "info";
                break;
            case 'itemUninstalled':
                $msg = "$param: Item uninstalled";
                $level = "success";
                break;
            default:
                break;
        }
        $this->write($msg, $level);
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    private function getImporterIdByItem($item)
    {
        $p = explode('.', $item, 2);
        if (2 === count($p)) {
            return $p[0];
        }
        throw new ApplicationItemManagerException("Invalid item notation: the format of an item is: importerId.itemName");
    }

    private function getItemNameByItem($item)
    {
        $p = explode('.', $item, 2);
        if (2 === count($p)) {
            return $p[1];
        }
        throw new ApplicationItemManagerException("Invalid item notation: the format of an item is: importerId.itemName");
    }

    private function normalizeItem($item)
    {
        if (false === strpos($item, '.') && null !== $this->defaultImporter) {
            $item = $this->defaultImporter . '.' . $item;
        }
        return $item;
    }

    protected function write($msg, $type)
    {
        echo $msg . PHP_EOL;
    }
}