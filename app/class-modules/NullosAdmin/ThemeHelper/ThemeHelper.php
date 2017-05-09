<?php


namespace Module\NullosAdmin\ThemeHelper;


use Kamille\Architecture\ApplicationParameters\ApplicationParameters;
use Kamille\Mvc\HtmlPageHelper\HtmlPageHelper;
use Kamille\Services\XLog;

class ThemeHelper implements ThemeHelperInterface
{

    private static $inst;
    private $loaded;


    public function __construct()
    {
        $this->loaded = [];
    }

    public static function inst()
    {
        if (null === self::$inst) {
            self::$inst = new static();
        }
        return self::$inst;
    }


    public function useLib($libName)
    {
        if (false === array_key_exists($libName, $this->loaded)) {
            $prefixUri = "/theme/" . ApplicationParameters::get("theme");
            $this->loaded[$libName] = true;
            switch ($libName) {
                //--------------------------------------------
                // ORIGINAL FROM GENTELELLA
                //--------------------------------------------
                case 'bootstrap-colorpicker':
                    HtmlPageHelper::js("$prefixUri/vendors/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css", null);
                    break;
                case 'bootstrap-daterangepicker':
                    HtmlPageHelper::js("$prefixUri/vendors/moment/min/moment.min.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/bootstrap-daterangepicker/daterangepicker.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/bootstrap-daterangepicker/daterangepicker.css", null);
                    break;
                case 'bootstrap-progressbar':
                    HtmlPageHelper::js("$prefixUri/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css", null);
                    break;
                case 'bootstrap-wysiwyg':
                    HtmlPageHelper::js("$prefixUri/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/jquery.hotkeys/jquery.hotkeys.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/google-code-prettify/src/prettify.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/google-code-prettify/bin/prettify.min.css", null);
                    break;
                case 'Chart':
                    HtmlPageHelper::js("$prefixUri/vendors/Chart.js/dist/Chart.min.js", null, null, false);
                    break;
                case 'dateJS':
                    HtmlPageHelper::js("$prefixUri/vendors/DateJS/build/date.js", null, null, false);
                    break;
                case 'dropzone':
                    HtmlPageHelper::js("$prefixUri/vendors/dropzone/dist/min/dropzone.min.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/dropzone/dist/min/dropzone.min.css", null);
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
                case 'gauge':
                    HtmlPageHelper::js("$prefixUri/vendors/gauge.js/dist/gauge.min.js", null, null, false);
                    break;
                case 'iCheck':
                    HtmlPageHelper::js("$prefixUri/vendors/iCheck/icheck.min.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/iCheck/skins/flat/green.css", null);
                    break;
                case 'JQVMap':
                    HtmlPageHelper::js("$prefixUri/vendors/jqvmap/dist/jquery.vmap.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/jqvmap/dist/maps/jquery.vmap.world.js", null, null, false);
                    HtmlPageHelper::js("$prefixUri/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/jqvmap/dist/jqvmap.min.css", null);
                    break;
                case 'parsley':
                    HtmlPageHelper::js("$prefixUri/vendors/parsleyjs/dist/parsley.min.js", null, null, false);
                    break;
                case 'scroller':
                    HtmlPageHelper::js("$prefixUri/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css", null);
                    break;
                case 'skycons':
                    HtmlPageHelper::js("$prefixUri/vendors/skycons/skycons.js", null, null, false);
                    break;
                case 'Switchery':
                    HtmlPageHelper::js("$prefixUri/vendors/switchery/dist/switchery.min.js", null, null, false);
                    HtmlPageHelper::css("$prefixUri/vendors/switchery/dist/switchery.min.css", null);
                    break;
                //--------------------------------------------
                // MINES
                //--------------------------------------------
                case 'dataTable':
                    // assert: DataTable module is installed
                    HtmlPageHelper::js("/modules/DataTable/datatable.js", "datatable", [], false);
                    HtmlPageHelper::css("$prefixUri/widgets/DataTable_DataTable/DataTable_DataTable.default.css", null);
                    break;
                default:
                    XLog::error('Module\NullosAdmin\ThemeHelper: Unknown library: ' . $libName);
                    break;
            }
        }
    }

    public static function getBsType($type)
    {
        switch ($type) {
            case 'error':
                return "danger";
                break;
            case 'warning':
            case 'info':
            case 'success':
                return $type;
                break;
            default:
                break;
        }
        return "default";
    }
}


