<?php

namespace Nip\Inflector\Traits;

use Nip\Inflector\Inflector;

/**
 * Trait MagicMethodsTrait
 * @package Nip\Inflector\Traits
 */
trait MagicMethodsTrait
{

    /**
     * @param $name
     * @param $arguments
     * @return string
     */
    public function __call($name, $arguments)
    {
        if ($this->hasInflection($name)) {
            return $this->doInflection($name, $arguments[0]);
        }
        throw new \BadFunctionCallException("invalid inflection {$name}");
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public static function __callStatic($name, $arguments)
    {
        return (new Inflector())->doInflection($name, $arguments[0]);
    }
}
