<?php


namespace Module\AutoAdmin\CrudGenerator;



use CrudGeneratorTools\Skinny\Generator\SkinnyModelGeneratorInterface;
use CrudGeneratorTools\Skinny\Util\SkinnyTypeUtil;
use CrudGeneratorTools\Util\ForeignKeyPreferredColumnUtil;
use Module\AutoAdmin\CrudGenerator\Skinny\Generator\NullosSkinnyModelGenerator;
use Module\AutoAdmin\CrudGenerator\Skinny\Generator\NullosskinnyTypeUtil;
use Module\AutoAdmin\CrudGenerator\Util\NullosForeignKeyPreferredColumnUtil;
use QuickPdo\Util\QuickPdoInfoCacheUtil;


/**
 * This is the NullosCrudGenerator made by the AutoAdmin planet.
 */
class NullosCrudGenerator
{

    /**
     * @var $logFunction , the function used to log this class activity.
     * It receives two arguments: type and msg.
     * Type can be one of: error, debug, maybe other types in the future.
     */
    private $logFunction;

    /**
     * @var ForeignKeyPreferredColumnUtil $foreignKeyPreferredColumnUtil
     */
    private $foreignKeyPreferredColumnUtil;

    /**
     * @var SkinnyTypeUtil $skinnyTypeUtil
     */
    private $skinnyTypeUtil;

    /**
     * @var SkinnyModelGeneratorInterface $skinnyModelGenerator
     */
    private $skinnyModelGenerator;

    /**
     * @var QuickPdoInfoCacheUtil $quickPdoInfoCache
     */
    private $quickPdoInfoCache;


    /**
     * @var bool, whether or not to use cache when available
     */
    private $_useCache;

    /**
     * @var string, name of the module, used by NullosskinnyTypeUtil
     * to generate parameters for autocomplete and upload types.
     */
    private $module;


    public function __construct()
    {
        $this->_useCache = true;
        $this->module = 'AutoAdmin';
    }


    public function generate($database)
    {
        $this->prepare();


    }

    public function useCache($useCache)
    {
        $this->_useCache = $useCache;
        return $this;
    }

    public function setModule($module)
    {
        $this->module = $module;
        return $this;
    }




    //--------------------------------------------
    //
    //--------------------------------------------
    public function setForeignKeyPreferredColumnUtil(ForeignKeyPreferredColumnUtil $foreignKeyPreferredColumnUtil)
    {
        $this->foreignKeyPreferredColumnUtil = $foreignKeyPreferredColumnUtil;
        return $this;
    }

    public function setSkinnyTypeUtil(SkinnyTypeUtil$skinnyTypeUtil)
    {
        $this->skinnyTypeUtil = $skinnyTypeUtil;
        return $this;
    }

    public function setQuickPdoInfoCache(QuickPdoInfoCacheUtil $quickPdoInfoCache)
    {
        $this->quickPdoInfoCache = $quickPdoInfoCache;
        return $this;
    }




    //--------------------------------------------
    //
    //--------------------------------------------
    private function prepare()
    {
        if (null === $this->foreignKeyPreferredColumnUtil) {
            $this->foreignKeyPreferredColumnUtil = NullosForeignKeyPreferredColumnUtil::create();
        }

        if (null === $this->quickPdoInfoCache) {
            $this->quickPdoInfoCache = QuickPdoInfoCacheUtil::create()->cache($this->_useCache);
        }
        if (null === $this->skinnyTypeUtil) {
            $this->skinnyTypeUtil = NullosSkinnyTypeUtil::create()
                ->setQuickPdoInfoCache($this->quickPdoInfoCache)
                ->setForeignKeyPreferredColumnUtil($this->foreignKeyPreferredColumnUtil)
                ->setModule($this->module)
                ->useCache($this->_useCache);
        }
        if (null === $this->skinnyModelGenerator) {
            $this->skinnyModelGenerator = NullosSkinnyModelGenerator::create()
                ->useCache($this->_useCache)
                ->setQuickPdoInfoCache($this->quickPdoInfoCache)
                ->setForeignKeyPreferredColumnUtil($this->foreignKeyPreferredColumnUtil)
                ->setSkinnyTypeUtil($this->skinnyTypeUtil)
            ;
        }
    }


    //--------------------------------------------
    // LOG
    //--------------------------------------------
    public function setLogFunction(callable $logFunction)
    {
        $this->logFunction = $logFunction;
        return $this;
    }

    private function debug($msg)
    {
        $this->log('debug', $msg);
    }

    private function error($msg)
    {
        $this->log('error', $msg);
    }

    private function log($type, $msg)
    {
        if (null !== $this->logFunction) {
            call_user_func($this->logFunction, $type, $msg);
        }
    }

    //--------------------------------------------
    //
    //--------------------------------------------
}
