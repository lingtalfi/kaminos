<?php


namespace Module\NullosAdmin\ThemeHelper;


interface ThemeHelperInterface{

    /**
     * Loads a js lib.
     * Available js libs are:
     *
     * - bootstrap-colorpicker
     * - bootstrap-daterangepicker
     * - bootstrap-progressbar
     * - Chart
     * - dateJS
     * - dropzone
     * - flot
     * - gauge
     * - iCheck
     * - JQVMap
     * - skycons
     * - Switchery
     */
    public function useLib($libName);

}