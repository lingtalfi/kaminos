<?php


namespace PersistentRowCollection;


interface PersistentRowCollectionInterface
{

    /**
     *
     * Insert a new row in the collection.
     *
     * @param array $row
     * @return array|false,
     *          Return false if something wrong happened.
     *          Return the ric array in case of success.
     *
     */
    public function create(array $row);

    /**
     *
     * Return the rows of the collection.
     *
     *
     * @param $page int, the current page to display.
     *                          If the $page is out of boundaries, it adapts the page number
     *                          to the nearest possible boundary.
     *
     * @param $nipp , int|null, the number of rows per page, or null to return all matching rows.
     * @param array $searchValues , an array of column => searchExpression
     *              A row match only if all searchValues match (implicit AND as combination operator).
     *
     *              Note: this syntax can be extended on a per implementation basis.
     *
     * @param array $sortValues , an array of column => sortDir
     *              sortDir is one of the following value: asc, desc, null.
     *              If a column is not set, a sortDir value of null is assumed.
     *
     *
     * @param int $nbTotalItems , the total number of items matching the request (all pages merged together)
     *
     * @return array, the rows matching the given criterion.
     */
    public function read(&$page, $nipp, array $searchValues = [], array $sortValues = [], &$nbTotalItems = 0);

    /**
     *
     * Update the row identified by the given ric with the given newRow.
     *
     * @param array $ric
     * @param array $newRow
     * @return bool, whether or not the update was successful
     */
    public function update(array $ric, array $newRow);

    /**
     *
     * Delete the row identified by the given ric
     *
     * @param array $ric
     * @return mixed
     */
    public function delete(array $ric);
}