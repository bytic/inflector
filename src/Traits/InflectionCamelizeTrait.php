<?php

namespace Nip\Inflector\Traits;

/**
 * Trait InflectionCamelizeTrait
 * @package Nip\Inflector\Traits
 *
 * @method camelize($string)
 */
trait InflectionCamelizeTrait
{


    /**
     * @param $word
     * @return string
     */
    protected function doCamelize($word)
    {
        return str_replace(' ', '', ucwords(preg_replace('/[^A-Z^a-z^0-9]+/', ' ', $word)));
    }
}
