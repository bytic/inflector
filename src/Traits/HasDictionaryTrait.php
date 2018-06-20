<?php

namespace Nip\Inflector\Traits;

/**
 * Trait HasDictionaryTrait
 * @package Nip\Inflector\Traits
 *
 * @method unclassify($string)
 */
trait HasDictionaryTrait
{
    protected static $dictionary;

    /**
     * @param $inflection
     * @param $string
     * @return bool
     */
    protected static function hasString($inflection, $string)
    {
        return isset(self::$dictionary[$inflection][$string]);
    }

    /**
     * @param $inflection
     * @param $string
     * @return bool
     */
    protected static function getString($inflection, $string)
    {
        if (!self::hasString($inflection, $string)) {
            throw new \BadMethodCallException("String {$string} is not contained in the {$inflection} dictionary");
        }
        return self::$dictionary[$inflection][$string];
    }

    /**
     * @param $inflection
     * @param $string
     * @param $value
     */
    protected static function setString($inflection, $string, $value)
    {
        self::$dictionary[$inflection][$string] = $value;
    }
}
