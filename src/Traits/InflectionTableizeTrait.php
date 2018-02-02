<?php

namespace Nip\Inflector\Traits;

/**
 * Trait InflectionTableizeTrait
 * @package Nip\Inflector\Traits
 *
 * @method tableize($string)
 */
trait InflectionTableizeTrait
{

    /**
     * Converts a class name to its table name according to rails
     * naming conventions.
     *
     * Converts "Person" to "people"
     *
     * @param string $class_name Class name for getting related table_name.
     * @return string plural_table_name
     */
    protected function doTableize($class_name)
    {
        return $this->pluralize($this->underscore($class_name));
    }
}
