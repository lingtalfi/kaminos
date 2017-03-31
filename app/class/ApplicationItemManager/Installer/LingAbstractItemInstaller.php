<?php

namespace ApplicationItemManager\Installer;


use Output\ProgramOutputAwareInterface;
use Output\ProgramOutputInterface;

abstract class LingAbstractItemInstaller implements InstallerInterface
{

    protected $applicationDirectory;
    protected $file;
    protected $installMethod;
    protected $uninstallMethod;
    /**
     * @var ProgramOutputInterface
     */
    protected $output;
    protected $itemType;

    public function __construct()
    {
        $this->installMethod = "install";
        $this->uninstallMethod = "uninstall";
        $this->itemType = "item";
    }


    public static function create()
    {
        return new static();
    }

    /**
     * @throws \Exception if the file cannot be returned
     */
    abstract protected function getFile();

    /**
     * @throws \Exception if it the installer instance cannot be returned
     */
    abstract protected function getInstallerClass($item);


    public function getList()
    {
        $ret = [];
        $f = $this->getFile();
        if (file_exists($f)) {
            $ret = file($f, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $ret = array_filter($ret);
            $ret = array_unique($ret);
        }
        return $ret;
    }


    public function setApplicationDirectory($applicationDirectory)
    {
        $this->applicationDirectory = $applicationDirectory;
        return $this;
    }


    public function setOutput(ProgramOutputInterface $output)
    {
        $this->output = $output;
        return $this;
    }


    public function install($item)
    {
        if (false !== ($oClass = $this->getInstallerInstance($item))) {
            if ($oClass instanceof ProgramOutputAwareInterface) {
                $oClass->setProgramOutput($this->output);
            }
            $installMethod = $this->installMethod;
            $oClass->$installMethod();


            $this->msg("installed", $item);
            $list = $this->getList();
            if (!in_array($item, $list)) {
                $list[] = $item;
            }
            $this->writeList($list);
        }
    }

    public function isInstalled($item)
    {
        $list = $this->getList();
        return in_array($item, $list, true);
    }

    public function uninstall($item)
    {
        if (false !== ($oClass = $this->getInstallerInstance($item))) {
            if ($oClass instanceof ProgramOutputAwareInterface) {
                $oClass->setProgramOutput($this->output);
            }
            $uninstallMethod = $this->uninstallMethod;
            $oClass->$uninstallMethod();

            $this->msg("uninstalled", $item);
            $list = $this->getList();
            if (false !== ($pos = array_search($item, $list))) {
                unset($list[$pos]);
                $this->writeList($list);
            }
        }
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function msg($type, $param = null)
    {
        $msg = "";
        $prefix = "*";
        $output = $this->output;
        $itemType = ucfirst($this->itemType);
        switch ($type) {
            case 'install':
                $msg = $prefix . "$itemType $param has been installed";
                $output->success($msg);
                break;
            case 'uninstall':
                $msg = $prefix . "$itemType $param has been uninstalled";
                $output->error($msg);
                break;
            default:
                break;
        }
        echo $msg . PHP_EOL;
    }



    //--------------------------------------------
    //
    //--------------------------------------------
    private function writeList(array $list)
    {
        $f = $this->getFile();
        file_put_contents($f, implode(PHP_EOL, $list));
    }

    private function getInstallerInstance($item)
    {
        $class = $this->getInstallerClass($item);
        if (class_exists($class)) {
            return new $class;
        }
        return false;
    }

}