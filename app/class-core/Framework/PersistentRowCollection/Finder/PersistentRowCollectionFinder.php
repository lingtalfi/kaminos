<?php


namespace Core\Framework\PersistentRowCollection\Finder;
use PersistentRowCollection\Finder\PersistentRowCollectionFinderInterface;
use PersistentRowCollection\PersistentRowCollectionInterface;


/**
 * This Finder uses a dynamic technique based on name convention:
 *
 * the name is composed of the ModuleName, followed by a dot, followed by the ClassIdentifier.
 * Since prc play a major role in an application using a database, they have their own directory: class-prc.
 *
 * So, the following prc architecture is assumed:
 *
 * - app
 * ----- class-prc
 * --------- $ModuleName
 * ------------- <$ClassIdentifier> <PersistentRowCollection> .php
 * ----------------- Auto
 * --------------------- <$ClassIdentifier> <PersistentRowCollection> .php
 *
 *
 * The auto directory is reserved for automatically generated PRCs.
 * And the PRC class directly at the root of the $ModuleName directory is used if found and has precedence
 * on the auto generated version, so that the user can override/extend the auto version.
 *
 *
 *
 */
class PersistentRowCollectionFinder implements PersistentRowCollectionFinderInterface
{
    /**
     *
     * Return the PersistentRowCollection identified by the given name,
     * or false if the object couldn't be found.
     *
     * @param $name
     * @return false|PersistentRowCollectionInterface
     */
    public function find($name)
    {
        $p = explode('.', $name);
        $p = array_map('ucfirst', $p);
        //
        $s = implode('\\', $p);
        $class = 'Prc\\' . $s . "PersistentRowCollection";
        if (class_exists($class)) {
            return new $class();
        } else {
            $last = array_pop($p);
            $p[] = 'Auto';
            $p[] = $last;

            $class = 'Prc\\' . implode('\\', $p) . "PersistentRowCollection";
            if (class_exists($class)) {
                return new $class();
            }

        }
        return false;
    }
}

