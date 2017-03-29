<?php


namespace ApplicationItemManager;


use ApplicationItemManager\Exception\ApplicationItemManagerException;
use ApplicationItemManager\Importer\ImporterInterface;
use ApplicationItemManager\Installer\InstallerInterface;
use ApplicationItemManager\ItemList\ItemListInterface;


/**
 * - item: (importerId.)itemName
 *          If importerId is omitted and a default importerId is set, then the default importerId is used.
 */
class ApplicationItemManager
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
     * @var ItemListInterface[]
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

    public function addItemList(ItemListInterface $itemList)
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
        $this->msg("importingItem", $item);
        $item = $this->normalizeItem($item);
        $itemName = $this->getItemNamedByItem($item);

        if (false === $force && true === $this->isImported($itemName)) {
            $this->msg("itemAlreadyImported", $item);
        } else {
            if (false !== ($importer = $this->findImporter($item))) {
                if (false !== ($itemList = $this->findItemList($item))) {
                    $tree = $itemList->getDependencyTree($item);
                    $this->msg("collectTree", $tree);
                    foreach ($tree as $treeItem) {
                        $treeItemName = $this->getItemNamedByItem($treeItem);
                        if (true === $this->isImported($treeItemName)) {
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
        $this->msg("installingItem", $item);
        $item = $this->normalizeItem($item);
        $itemName = $this->getItemNamedByItem($item);

        if (true === $force || false === $this->installer->isInstalled($itemName)) {

            $itemsToInstall = [];
            if (false !== ($itemList = $this->findItemList($item))) {
                $tree = $itemList->getDependencyTree($item);
                $itemsToInstall = $tree;
                $this->msg("collectTree", $tree);
                foreach ($tree as $treeItem) {
                    $this->doImport($treeItem, $force, true);
                }
            } else {
                $itemsToInstall[] = $item;
                $this->msg("itemNotFoundInList", $item);
            }


            // ath this point, all items are imported, we install non installed items
            foreach ($itemsToInstall as $itemToInstall) {
                $itemName = $this->getItemNamedByItem($itemToInstall);
                if (false === $force && true === $this->installer->isInstalled($itemName)) {
                    $this->msg("alreadyInstalled", $itemToInstall);
                } elseif (true === $force || false === $this->installer->isInstalled($itemName)) {
                    $this->installer->install($itemName, $force);
                    $this->msg("itemInstalled", $itemToInstall);
                }
            }
        } else {
            $this->msg("alreadyInstalled", $item);
        }
        return false;
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    protected function doImport($item, $force = false, $quiet = false)
    {
        if (false !== ($importer = $this->findImporter($item))) {
            $itemName = $this->getItemNamedByItem($item);
            $importer->import($itemName, $this->importDirectory, $force);
            if (false === $quiet) {
                $this->msg("itemImported", $item);
            }
        } else {
            if (false === $quiet) {
                $this->msg("importerNotFound", $item);
            }
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
     * @return ItemListInterface|false
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
        switch ($type) {
            case 'importingItem':
                $msg = "Preparing import for item $param";
                break;
            case 'importerNotFound':
                $msg = "No importer was found for item $param";
                break;
            case 'itemNotFoundInList':
                $msg = "Item not found in any list: $param";
                break;
            case 'itemAlreadyImported':
                $msg = "$param: Item already imported";
                break;
            case 'itemImported':
                $msg = "$param: Item imported";
                break;
            case 'collectTree':
                $msg = "Collecting dependencies: " . implode(', ', $param);
                break;
            case 'installingItem':
                $msg = "Preparing installation for item $param";
                break;
            case 'alreadyInstalled':
                $msg = "$param: Item already installed";
                break;
            case 'itemInstalled':
                $msg = "$param: Item installed";
                break;
            default:
                break;
        }
        echo $msg . PHP_EOL;
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

    private function getItemNamedByItem($item)
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
}