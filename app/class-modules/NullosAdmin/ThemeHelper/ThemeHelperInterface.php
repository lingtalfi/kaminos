<?php


namespace Module\NullosAdmin\ThemeHelper;


interface ThemeHelperInterface{

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
    public function useLib($libName);
}