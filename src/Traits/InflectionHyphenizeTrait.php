<?php

namespace Nip\Inflector\Traits;

/**
 * Trait InflectionHyphenizeTrait
 * @package Nip\Inflector\Traits
 *
 * @method hyphenize($string)
 */
trait InflectionHyphenizeTrait
{

    /**
     * @param $word
     * @return string
     */
    protected function doHyphenize($word)
    {
        $word = $this->doUnderscore($word);

        return str_replace('_', '-', $word);
    }
}
