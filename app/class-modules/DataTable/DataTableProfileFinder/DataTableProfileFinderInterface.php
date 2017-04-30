<?php


namespace Module\DataTable\DataTableProfileFinder;


interface DataTableProfileFinderInterface
{
    /**
     * @return array|false, the datatable profile if found, or false otherwise.
     *
     * The datatable profile looks like this:
     *
     * - rowsGenerator:
     *      - type: array|rows
     *      - path: Only if type is array. The path to the file containing the array.
     *                              The array should be referenced with the variable $rows.
     *
     *
     *
     *
     *
     */
    public function getProfile($profileId);
}