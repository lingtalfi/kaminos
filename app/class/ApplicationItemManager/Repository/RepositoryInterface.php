<?php


namespace ApplicationItemManager\Repository;

/**
 * A repository is a publicly accessible entity
 * which contains a certain type of item (for instance a module repository, or a widget repository,
 * or a theme repository, and so on...).
 *
 * The notation for an item is the following:
 * - item: repositoryId.itemName
 *
 * That's because an item with the same itemName might be potentially available from two different repositories
 * (that should be rare though), and so the repositoryId helps targeting precisely the item we want.
 *
 *
 *
 */
interface RepositoryInterface
{

    /**
     * Returns an array containing the dependencies, recursively, for the given item.
     * Each entry of the array is an item (item is defined above).
     */
    public function getDependencies($item);


    /**
     * Some items only make sense in the context of a parent item.
     * So that if the parent item is removed, it doesn't make sense to keep the children items in the application.
     *
     * A hard dependency is the term used for this type of relationship.
     *
     * A child item with a hard dependency to a parent item is uninstalled when the parent is uninstalled.
     *
     */
    public function getHardDependencyTree($item);


    /**
     * Returns whether or not the repository contains the given item.
     */
    public function has($item);

    /**
     * in: an array of where to search, and also what to return.
     *          If null, will search the item and return a one dimensional array containing only matching items.
     *
     *          If an array, return a multidimensional array (with keys being the items) containing the specified keys.
     *          You need to specifiy the item key in the array if you want to search in the item.
     *
     *          Depending on your list, you might have keys like for instance:
     *              - item
     *              - description
     *              - other things depending on what the list has
     *
     *          If a key is specified and it doesn't exist in the list, it does not return
     *          an error, but simply ignores the key.
     */
    public function search($text, array $in = null);


    /**
     * returns the list of all items.
     * If keys is null, returns a flat list (one dimension array).
     * If keys is an array, returns an array containing the keys as keys, and the corresponding
     * values (or null if not set) as values.
     */
    public function all(array $keys = null);

}