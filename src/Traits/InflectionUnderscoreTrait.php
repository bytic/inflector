<?php

namespace Nip\Inflector\Traits;

/**
 * Trait InflectionUnderscoreTrait
 * @package Nip\Inflector\Traits
 *
 * @method underscore($string)
 */
trait InflectionUnderscoreTrait
{

    /**
     * @param $word
     * @return string
     */
    protected function doUnderscore($word)
    {
        return strtolower(
            preg_replace(
                '/[^A-Z^a-z^0-9]+/',
                '_',
                preg_replace(
                    '/([a-zd])([A-Z])/',
                    '\1_\2',
                    preg_replace(
                        '/([A-Z]+)([A-Z][a-z])/',
                        '\1_\2',
                        $word
                    )
                )
            )
        );
    }
}
