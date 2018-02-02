<?php

namespace Nip\Inflector\Traits;

/**
 * Trait InflectionClassifyTrait
 * @package Nip\Inflector\Traits
 *
 * @method classify($string)
 */
trait InflectionClassifyTrait
{

    /**
     * Converts lowercase string to underscored camelize class format
     *
     * @param string $string
     * @return string
     */
    protected function doClassify($string)
    {
        $parts = explode("-", $string);
        $parts = array_map([$this, "camelize"], $parts);

        return implode("_", $parts);
    }
}
