<?php


namespace ApplicationItemManager;


use ApplicationItemManager\Exception\ApplicationItemManagerException;
use ApplicationItemManager\Importer\Exception\ImporterException;
use ApplicationItemManager\Importer\ImporterInterface;
use ApplicationItemManager\Installer\InstallerInterface;
use ApplicationItemManager\Repository\RepositoryInterface;


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
    protected $repositories;
    private $importDirectory;

    private $favoriteRepositoryId;
    private $debugMode;

    /**
     * @var array repositories, no aliases
     */
    private $_repositories;


    public function __construct()
    {
        $this->repositories = [];
        $this->importers = [];
        $this->debugMode = false;
    }


    public static function create()
    {
        return new static();
    }

    /**
     * @return ApplicationItemManager
     */
    public function bindImporter($repositoryId, ImporterInterface $importer)
    {
        $this->importers[$repositoryId] = $importer;
        return $this;
    }

    /**
     * @return ApplicationItemManager
     */
    public function setInstaller(InstallerInterface $installer)
    {
        $this->installer = $installer;
        return $this;
    }

    /**
     * @return ApplicationItemManager
     */
    public function addRepository(RepositoryInterface $repository, array $aliases = [])
    {

        $name = $repository->getName();

        $this->repositories[$name] = $repository;

        if (!in_array($name, $this->repositories, true)) {
            $this->_repositories[] = $name;
        }

        // let's flatten all aliases right now, because why not?
        foreach ($aliases as $alias) {
            $this->repositories[$alias] = $repository;
        }
        return $this;
    }

    public function setImportDirectory($importDirectory)
    {
        $this->importDirectory = $importDirectory;
        return $this;
    }

    public function setFavoriteRepositoryId($favoriteRepositoryId)
    {
        $this->favoriteRepositoryId = $favoriteRepositoryId;
        return $this;
    }

    public function setDebugMode($debugMode)
    {
        $this->debugMode = $debugMode;
        return $this;
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    public function listAvailable($repoId = null, array $keys = null)
    {
        $repoIds = [];
        if (null === $repoId) {
            $repoIds = $this->_repositories;
        } else {
            if (false === array_key_exists($repoId, $this->repositories)) {
                throw new ApplicationItemManagerException("Repo id doesn't exist: $repoId");
            }
            $repoIds = [$repoId];
        }


        $ret = [];
        if (null === $keys) {
            // returning flat items
            foreach ($repoIds as $repoId) {
                $repo = $this->repositories[$repoId];
                $all = $repo->all($keys);
                $ret = array_merge($ret, $all);
            }
        } else {
            // returning combined items
            foreach ($repoIds as $repoId) {
                $repo = $this->repositories[$repoId];
                $all = $repo->all($keys);
                $repoName = $repo->getName();
                foreach ($all as $itemName => $metas) {
                    $ret[$repoName . "." . $itemName] = $metas;
                }
            }
        }
        return $ret;
    }


    public function listImported()
    {
        $d = $this->importDirectory;
        $files = scandir($d);
        $ret = [];
        foreach ($files as $f) {
            if ('.' !== $f && '..' !== $f) {
                if (is_dir($d . "/" . $f)) {
                    $ret[] = $f;
                }
            }
        }
        return $ret;
    }


    public function listInstalled()
    {
        if (null === $this->installer) {
            throw new ApplicationItemManagerException("Not applicable: no installer set");
        }
        return $this->installer->getList();
    }

    public function search($text, array $keys = null, $repoId = null)
    {
        $repoIds = [];
        if (null === $repoId) {
            $repoIds = $this->_repositories;
        } else {
            if (false === array_key_exists($repoId, $this->repositories)) {
                throw new ApplicationItemManagerException("Repo id doesn't exist: $repoId");
            }
            $repoIds = [$repoId];
        }

        $ret = [];
        if (null === $keys) {
            // returning flat items
            foreach ($repoIds as $repoId) {
                $repo = $this->repositories[$repoId];
                $all = $repo->search($text, $keys);
                $ret = array_merge($ret, $all);
            }
        } else {
            // returning combined items
            foreach ($repoIds as $repoId) {
                $repo = $this->repositories[$repoId];
                $all = $repo->search($text, $keys);
                $repoName = $repo->getName();
                foreach ($all as $itemName => $metas) {
                    $ret[$repoName . "." . $itemName] = $metas;
                }
            }
        }
        return $ret;
    }


    public function import($item, $force = false)
    {
        if (false !== ($repoId = $this->getRepoId($item))) {
            $this->msg("importingItem", $item);
            return $this->handleProcedure("import", $item, $repoId, $force);
        }
        return false;
    }


    public function install($item, $force = false)
    {
        if (false !== ($repoId = $this->getRepoId($item))) {
            $this->msg("installingItem", $item);
            return $this->handleProcedure("install", $item, $repoId, $force);
        }
        return false;
    }


    public function uninstall($item)
    {
        if (false !== ($repoId = $this->getRepoId($item))) {
            $this->msg("uninstallingItem", $item);

            $itemName = $this->getItemNameByItem($item);
            $r = $this->doUninstall($itemName);
            if (false === $r) {
                return false;
            } else {
                if (null === $repoId) {
                    return true;
                } elseif (array_key_exists($repoId, $this->repositories)) {
                    $itemName = $this->getItemNameByItem($item);

                    $repo = $this->repositories[$repoId];
                    $deps = $repo->getHardDependencies($itemName);

                    $this->msg("checkingHardDependencies", $itemName, $deps);

                    $allDepsOk = true;
                    foreach ($deps as $dep) {
                        $this->msg("uninstallingDependencyItem", $dep);
                        $depName = $this->getItemNameByItem($dep);
                        $r = $this->doUninstall($depName);
                        if (false === $r) {
                            $allDepsOk = false;
                        }
                    }
                    return $allDepsOk;
                } else {
                    throw new \LogicException("no repository set for repoId $repoId");
                }
            }
        }
        return false;
    }

    private function doUninstall($itemName)
    {
        try {
            return $this->installer->uninstall($itemName);
        } catch (\Exception $e) {
            $this->msg("uninstallProblem", $itemName, $e);
            return false;
        }
    }


    //--------------------------------------------
    //
    //--------------------------------------------
    protected function doInstall($itemName, $repoId = null, $force = false)
    {
        if (false === $force) {
            // is already imported?
            if (true === $this->isInstalled($itemName)) {
                $this->msg("itemAlreadyInstalled", $itemName);
                return true;
            }
        }

        if (false === $this->isImported($itemName)) {
            $this->msg("itemNotInstalledNotImported", $itemName);
            $force = false; // we don't need to force imports
            $this->doImport($itemName, $repoId, $force);
        }

        try {
            if (true === $this->installer->install($itemName)) {
                $this->msg("itemInstalled", $itemName);
            } else {
                $this->msg("itemNotInstalled", $itemName);
            }
        } catch (\Exception $e) {
            $this->msg("installProblem", $itemName, $e);
        }
        return false;
    }


    protected function doImport($itemName, $repoId = null, $force = false)
    {
        if (false === $force) {
            // is already imported?
            if (true === $this->isImported($itemName)) {
                $this->msg("itemAlreadyImported", $itemName);
                return true;
            }
        }

        $this->msg("findingImporter");
        if (false !== ($importer = $this->findImporter($repoId))) {
            $this->msg("importerFound", $importer, $repoId);

            try {
                if (true === $importer->import($itemName, $this->importDirectory, $force)) {
                    $this->msg("itemImported", $itemName, $repoId);
                    return true;
                }
            } catch (ImporterException $e) {
                $this->msg("importerProblem", $itemName, $e);
            }
        } else {
            $this->msg("importerNotFound", $repoId);
        }
        return false;
    }


    /**
     * @return ImporterInterface|false
     */
    protected function findImporter($repoId)
    {
        if (array_key_exists($repoId, $this->importers)) {
            return $this->importers[$repoId];
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
        foreach ($this->repositories as $itemList) {
            if (true === $itemList->has($item)) {
                return $itemList;
            }
        }
        return false;
    }

    protected function msg($type, $param = null, $param2 = null)
    {
        $msg = "";
        $level = "info";
        switch ($type) {
            //--------------------------------------------
            // IMPORT/INSTALL
            //--------------------------------------------
            case 'checkingRepo':
                $msg = "checking repo from $param...";
                $level = "debug";
                break;
            case 'noRepositoryFound':
                $msg = "repo not found for $param";
                $level = "debug";
                break;
            case 'invalidRepository':
                $msg = "invalid repository $param";
                $level = "error";
                break;
            case 'repositoryFound':
                $msg = "repo found for $param: $param2";
                $level = "debug";
                break;
            case 'importingItem':
                $msg = "importing item $param";
                $level = "info";
                break;
            case 'installingItem':
                $msg = "installing item $param";
                $level = "info";
                break;
            case 'checkingDependencies':
                $msg = "checking dependencies for $param:";
                if (count($param2) > 0) {
                    $br = PHP_EOL;
                    $msg .= $br;
                    $msg .= "- ";
                    $msg .= implode($br . "- ", $param2);
                } else {
                    $msg .= " none";
                }
                $level = "info";
                break;
            case 'importingDependencyItem':
                $msg = "importing dependency item $param";
                $level = "info";
                break;
            case 'installingDependencyItem':
                $msg = "installing dependency item $param";
                $level = "info";
                break;
            //--------------------------------------------
            // DO IMPORT
            //--------------------------------------------
            case 'itemAlreadyImported':
                $msg = "$param already imported";
                $level = "success";
                break;
            case 'findingImporter':
                $msg = "finding importer...";
                $level = "debug";
                break;
            case 'importerFound':
                $msg = "importer found: " . get_class($param);
                $level = "debug";
                break;
            case 'itemImported':
                $msg = "$param imported from repository $param2";
                $level = "success";
                break;
            case 'importerProblem':
                $msg = "A problem occurred with the import: " . $param2->getMessage();
                $level = "error";
                break;
            case 'importerNotFound':
                $msg = "no importer is able to handle repository $param";
                $level = "error";
                break;
            //--------------------------------------------
            // DO INSTALL
            //--------------------------------------------
            case 'itemAlreadyInstalled':
                $msg = "$param already installed";
                $level = "success";
                break;
            case 'itemNotInstalledNotImported':
                $msg = "$param not installed and not imported. Trying to import $param";
                $level = "info";
                break;
            case 'itemInstalled':
                $msg = "$param installed";
                $level = "success";
                break;
            case 'installProblem':
                $msg = "a problem occurred with the install: " . $param2->getMessage();
                $level = "error";
                break;
            case 'itemNotInstalled':
                $msg = "item $param couldn't be installed: no reason was given.";
                $level = "error";
                break;
            //--------------------------------------------
            // UNINSTALL
            //--------------------------------------------
            case 'uninstallingItem':
                $msg = "uninstalling " . $param;
                $level = "info";
                break;
            case 'checkingHardDependencies':
                $msg = "checking hard dependencies for $param:";
                if (count($param2) > 0) {
                    $br = PHP_EOL;
                    $msg .= $br;
                    foreach ($param2 as $dep) {
                        $msg .= "- $dep" . $br;
                    }
                } else {
                    $msg .= " none";
                }
                $level = "info";
                break;
            case 'uninstallingDependencyItem':
                $msg = "uninstalling dependency " . $param;
                $level = "info";
                break;
            case 'uninstallProblem':
                $msg = "uninstall problem: " . $param2->getMessage();
                $level = "error";
                break;
            default:
                break;
        }


        $levelsOff = ['debug'];
        if (false === $this->debugMode && in_array($level, $levelsOff, true)) {
            return;
        }
        $this->write($msg, $level);
    }

    protected function write($msg, $type)
    {
        echo $msg . PHP_EOL;
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    private function getItemNameByItem($item)
    {
        $p = explode('.', $item, 2);
        if (2 === count($p)) {
            return $p[1];
        }
        return $item;
    }

    private function getRepoId($item)
    {
        $this->msg("checkingRepo", $item);
        $repoId = $this->findRepo($item, $this->favoriteRepositoryId);
        if (null === $repoId) {
            $this->msg("noRepositoryFound", $item);
            if (false !== strpos($item, '.')) {
                $p = explode('.', $item);
                $this->msg("invalidRepository", $p[0]);
                return false;
            }
        } else {
            $this->msg("repositoryFound", $item, $repoId);
        }
        return $repoId;
    }

    private function findRepo($item, $favoriteRepositoryId)
    {
        // itemId, the choice is non negotiable
        if (false !== strpos($item, '.')) {
            $p = explode(".", $item, 2);
            $repoId = $p[0];
            if (array_key_exists($repoId, $this->repositories)) {
                return $this->repositories[$repoId]->getName();
            }
        } else {
            // itemName
            // do we have a favorite choice?
            if (null !== $favoriteRepositoryId) {
                if (array_key_exists($favoriteRepositoryId, $this->repositories)) {
                    $repo = $this->repositories[$favoriteRepositoryId];
                    if (true === $repo->has($item)) {
                        return $repo->getName();
                    }
                }
            }

            // fallback solution, ask all repos
            foreach ($this->repositories as $repository) {
                if (true === $repository->has($item)) {
                    return $repository->getName();
                }
            }
        }
        return null;
    }


    private function handleProcedure($type, $item, $repoId, $force)
    {

        if ('install' === $type) {
            $method = 'doInstall';
            $msgType = "installingDependencyItem";
        } else {
            $method = 'doImport';
            $msgType = "importingDependencyItem";
        }

        $itemName = $this->getItemNameByItem($item);

        $r = $this->$method($itemName, $repoId, $force);
        if (false === $r) {
            return false;
        } else {
            if (null === $repoId) {
                return true;
            } elseif (array_key_exists($repoId, $this->repositories)) {
                $itemName = $this->getItemNameByItem($item);

                $repo = $this->repositories[$repoId];
                $deps = $repo->getDependencies($itemName);

                $this->msg("checkingDependencies", $itemName, $deps);
                $allDepsOk = true;
                foreach ($deps as $dep) {
                    $this->msg($msgType, $dep);
                    $depName = $this->getItemNameByItem($dep);
                    $r = $this->$method($depName, $repoId);
                    if (false === $r) {
                        $allDepsOk = false;
                    }
                }
                return $allDepsOk;
            } else {
                throw new \LogicException("no repository set for repoId $repoId");
            }
        }
    }

    private function isInstalled($itemName)
    {
        return $this->installer->isInstalled($itemName);
    }

}