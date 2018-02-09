<?php

if (!function_exists('inflector')) {
    /**
     * @return Nip\Inflector\Inflector
     */
    function inflector()
    {
        if (function_exists('app')) {
            return app('inflector');
        }
        return \Nip\Inflector\Inflector::instance();
    }
}
