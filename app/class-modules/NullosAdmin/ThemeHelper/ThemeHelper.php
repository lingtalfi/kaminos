<?php


namespace Module\NullosAdmin\ThemeHelper;


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;
use Kamille\Services\XLog;

class ThemeHelper implements ThemeHelperInterface
{

    private $loaded;


    public function __construct()
    {
        $this->loaded = [];
    }

    public static function create()
    {
        return new static();
    }

    /**
     * Loads a js lib.
     * Available js libs are:
     *
     * - Chart
     * - gauge
     * - bootstrap-progressbar
     * - iCheck
     * - skycons
     * - flot
     * - dateJS
     * - JQVMap
     * - bootstrap-daterangepicker
     */
    public function useLib($libName)
    {
        if (false === array_key_exists($libName, $this->loaded)) {
            $prefixUri = "/theme/" . ApplicationParameters::get("theme");
            $this->loaded[$libName] = true;
            switch ($libName) {
                case 'Chart':
                    HtmlPageHelper::js("$prefixUri/vendors/Chart.js/dist/Chart.min.js", null, null, false);
                    break;
                case 'gauge':
                    HtmlPageHelper::js("$prefixUri/vendors/gauge.js/dist/gauge.min.js", null, null, false);
                    break;
                case 'bootstrap-progressbar':
                    HtmlPageHelper::js("$prefixUri/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css", null);
                    break;
                case 'iCheck':
                    HtmlPageHelper::js("$prefixUri/vendors/iCheck/icheck.min.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/iCheck/skins/flat/green.css", null);
                    break;
                case 'skycons':
                    HtmlPageHelper::js("$prefixUri/vendors/skycons/skycons.js", null, null, false);
                    break;
                case 'flot':
                    HtmlPageHelper::js("$prefixUri/vendors/Flot/jquery.flot.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/Flot/jquery.flot.pie.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/Flot/jquery.flot.time.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/Flot/jquery.flot.stack.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/Flot/jquery.flot.resize.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/flot.orderbars/js/jquery.flot.orderBars.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/flot-spline/js/jquery.flot.spline.min.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/flot.curvedlines/curvedLines.js", null, null, false);
                    break;
                case 'dateJS':
                    HtmlPageHelper::js("$prefixUri/vendors/DateJS/build/date.js", null, null, false);
                    break;
                case 'JQVMap':
                    HtmlPageHelper::js("$prefixUri/vendors/jqvmap/dist/jquery.vmap.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/jqvmap/dist/maps/jquery.vmap.world.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/jqvmap/dist/jqvmap.min.css", null);
                    break;
                case 'bootstrap-daterangepicker':
                    HtmlPageHelper::js("$prefixUri/vendors/moment/min/moment.min.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/bootstrap-daterangepicker/daterangepicker.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/bootstrap-daterangepicker/daterangepicker.css", null);
                    break;
                default:
                    XLog::error('Module\NullosAdmin\ThemeHelper: Unknown library: ' . $libName);
                    break;
            }
        }
    }
}


