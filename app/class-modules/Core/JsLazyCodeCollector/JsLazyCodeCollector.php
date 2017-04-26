<?php


namespace Module\Core\JsLazyCodeCollector;


class JsLazyCodeCollector implements JsLazyCodeCollectorInterface
{

    private $codes;
    private $wrappers;


    public function __construct()
    {
        $this->codes = [];
        $this->wrappers = [];
    }

    public static function create()
    {
        return new static();
    }


    public function addJsCode($groupId, $code)
    {
        $this->codes[$groupId][] = $code;
        return $this;
    }


    public function addCodeWrapper($groupId, callable $wrapper)
    {
        $this->wrappers[$groupId] = $wrapper;
        return $this;
    }


    public function getSnippets()
    {
        $s = '<script>' . PHP_EOL;
        foreach ($this->codes as $groupId => $codes) {
            $section = $this->getSection($groupId, $codes);
            $s .= $section . PHP_EOL;
        }
        $s .= '</script>' . PHP_EOL;
        return [$s];
    }

    //--------------------------------------------
    //
    //--------------------------------------------
    protected function getSection($groupId, array $codes)
    {
        if (array_key_exists($groupId, $this->wrappers)) {
            $wrapper = $this->wrappers[$groupId];
        } else {
            $wrapper = function ($s) {
                return $s;
            };
        }
        $sep = PHP_EOL;
        return call_user_func($wrapper, implode($sep, $codes));
    }

}