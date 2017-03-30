<?php


namespace ApplicationItemManager\ItemList;

use ApplicationItemManager\Exception\ApplicationItemManagerException;

/**
 * A dependency map is an array of item => array of dependencies.
 * Eah dependency is an item.
 * Hard dependencies are prefixed with a plus symbol (+)
 *
 *
 * A meta map is an array of item => metas.
 * Metas is an array of key => value.
 * Most common keys is description, but you can also have other keys like description.
 *
 *
 *
 *
 */
abstract class AbstractItemList implements ItemListInterface
{
    private $metaMap;
    private $dependencyMap;
    private $caseSensitiveSearch;


    public function __construct()
    {
        $this->caseSensitiveSearch = false;
    }

    public static function create()
    {
        return new static();
    }

    public function setCaseSensitiveSearch($caseSensitiveSearch)
    {
        $this->caseSensitiveSearch = $caseSensitiveSearch;
        return $this;
    }


    public function getDependencyTree($item)
    {
        $tree = [];
        $this->collectDependencyTree($item, $tree);
        $tree = array_map(function ($v) {
            return ltrim($v, '+');
        }, $tree);
        $tree = array_unique($tree);
        return $tree;
    }

    public function getHardDependencyTree($item)
    {
        $tree = [];
        $this->collectDependencyTree($item, $tree, function ($v) {
            if (0 === strpos($v, '+')) {
                return true;
            }
            return false;
        });
        $tree = array_map(function ($v) {
            return ltrim($v, '+');
        }, $tree);
        $tree = array_unique($tree);
        return $tree;

    }

    public function has($item)
    {
        $d = $this->getDependencyMap();
        return array_key_exists($item, $d);
    }

    public function search($text, array $in = null)
    {
        $map = $this->getMetaMap();
        $ret = [];
        $fn = (false === $this->caseSensitiveSearch) ? 'stripos' : 'strpos';
        if (null === $in) {
            foreach ($map as $k => $v) {
                if (false !== call_user_func($fn, $k, $text)) {
                    $ret[] = $k;
                }
            }
        } elseif (is_array($in)) {
            foreach ($map as $k => $mapItem) {
                $mapItem['item'] = $k;
                foreach ($in as $key) {
                    if (array_key_exists($key, $mapItem) && false !== call_user_func($fn, $mapItem[$key], $text)) {
                        $ret[$k] = $this->getCombinedArray($in, $mapItem);
                    }
                }
            }
        } else {
            throw new ApplicationItemManagerException("Invalid in argument format: an array or null was expected");
        }
        return $ret;
    }


    /**
     * returns the list of all items.
     * If keys is null, returns a flat list (one dimension array).
     * If keys is an array, returns an array containing the keys as keys, and the corresponding
     * values (or null if not set) as values.
     */
    public function all(array $keys = null)
    {
        if (null === $keys) {
            return array_keys($this->getDependencyMap());
        }
        $ret = [];
        $map = $this->getMetaMap();
        foreach ($map as $k => $mapItem) {
            $ret[$k] = $this->getCombinedArray($keys, $mapItem);
        }
        return $ret;
    }



    //--------------------------------------------
    // OVERRIDE THOSE METHODS
    //--------------------------------------------
    /**
     * @return array of item => metaArray
     * metaArray:
     *      - deps: array of dependencies (each dependency is an item)
     *      - other keys, like description for instance
     */
    protected function createItemList()
    {
        return [];
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    private function getDependencyMap()
    {
        if (null === $this->dependencyMap) {
            $all = $this->createItemList();
            foreach ($all as $k => $v) {
                $this->dependencyMap[$k] = $v['deps'];
            }
        }
        return $this->dependencyMap;
    }

    private function getMetaMap()
    {
        if (null === $this->metaMap) {
            $this->metaMap = $this->createItemList();
            foreach ($this->metaMap as $k => $v) {
                unset($this->metaMap[$k]['deps']);
            }
        }
        return $this->metaMap;
    }


    private function collectDependencyTree($items, array &$tree, callable $filter = null)
    {
        $dependencyMap = $this->getDependencyMap();
        if (is_string($items)) {
            $itemName = $items;
            $tree[] = $itemName;
            if (array_key_exists($itemName, $dependencyMap)) {
                $deps = $dependencyMap[$itemName];
                foreach ($deps as $dep) {
                    if (!in_array($dep, $tree, true)) {
                        $this->collectDependencyTree($dep, $tree);
                    }
                }
            }
        } elseif (is_array($items)) {
            foreach ($items as $item) {
                if (null !== $filter && false === call_user_func($filter, $item)) {
                    continue;
                }
                $this->collectDependencyTree($item, $tree);
            }
        }
    }

    private function getCombinedArray(array $in, array $meta)
    {
        $ret = [];
        foreach ($in as $v) {
            $ret[$v] = array_key_exists($v, $meta) ? $meta[$v] : null;
        }
        return $ret;
    }
}