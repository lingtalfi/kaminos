<?php


namespace Module\NullosAdmin\ThemeHelper;


interface ThemeHelperInterface{

    /**
     * Loads a js lib.
     * Available js libs are:
     *
     * - autocomplete
     * - bootstrap-colorpicker
     * - bootstrap-daterangepicker
     * - bootstrap-progressbar
     * - bootstrap-wysiwyg
     * - Chart
     * - dateJS
     * - dropzone
     * - flot
     * - gauge
     * - iCheck
     * - JQVMap
     * - parsley
     * - scroller
     * - skycons
     * - Switchery
     *
     *
     * Plus the following that I added
     *
     * - dataTable
     */
    public function useLib($libName);

}