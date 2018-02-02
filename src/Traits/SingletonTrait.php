<?php

namespace Nip\Inflector\Traits;

/**
 * Trait SingletonTrait
 * @package Nip\Inflector\Traits
 */
trait SingletonTrait
{

    /**
     * Singleton
     *
     * @return self
     */
    public static function instance()
    {
        static $instance;
        if (!($instance instanceof self)) {
            $instance = new self();
        }
        return $instance;
    }
}
