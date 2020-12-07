<?php

if (!function_exists('inflector')) {
    /**
     * @return Nip\Inflector\Inflector
     */
    function inflector(): \Nip\Inflector\Inflector
    {
        if (function_exists('app') && app()->has('inflector')) {
            return app('inflector');
        }
        return \Nip\Inflector\Inflector::instance();
    }
}
