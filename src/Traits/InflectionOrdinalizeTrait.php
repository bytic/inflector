<?php

namespace Nip\Inflector\Traits;

/**
 * Trait InflectionOrdinalizeTrait
 * @package Nip\Inflector\Traits
 *
 * @method ordinalize($string)
 */
trait InflectionOrdinalizeTrait
{


    /**
     * @param $number
     * @return string
     */
    protected function doOrdinalize($number)
    {
        if (in_array(($number % 100), range(11, 13))) {
            return $number . 'th';
        } else {
            switch (($number % 10)) {
                case 1:
                    return $number . 'st';
                    break;
                case 2:
                    return $number . 'nd';
                    break;
                case 3:
                    return $number . 'rd';
                default:
                    return $number . 'th';
                    break;
            }
        }
    }
}
