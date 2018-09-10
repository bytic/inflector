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
        $partsNamespace = explode('\\', $string);
        $return = [];
        foreach ($partsNamespace as $partNamespace) {
            $parts = explode("-", $partNamespace);
            $parts = array_map([$this, "camelize"], $parts);

            $return[] = implode("_", $parts);
        }
        return implode('\\', $return);
    }
}
