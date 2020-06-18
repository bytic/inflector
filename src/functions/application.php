<?php

if (!function_exists('inflector')) {
    /**
     * @return Nip\Inflector\Inflector
     */
    function inflector()
    {
        return app('inflector');
    }
}
