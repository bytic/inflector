<?php

namespace Nip\Inflector\Traits;

/**
 * Trait InflectionUnclasifyTrait
 * @package Nip\Inflector\Traits
 *
 * @method unclassify($string)
 */
trait InflectionUnclasifyTrait
{

    /**
     * Reverses classify()
     *
     * @param string $string
     * @return string
     */
    protected function doUnclassify($string)
    {
        $string = str_replace('\\', '_', $string);
        $parts = explode("_", $string);
        $parts = array_map([$this, "underscore"], $parts);

        return implode("-", $parts);
    }
}
