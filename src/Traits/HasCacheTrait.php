<?php

namespace Nip\Inflector\Traits;

/**
 * Trait HasCacheTrait
 * @package Nip\Inflector
 */
trait HasCacheTrait
{
    protected $cacheFile = null;

    protected $toCache = false;
    /**
     * @param string $directory
     */
    public function setCachePath($directory)
    {
        $file = $directory . DIRECTORY_SEPARATOR . 'inflector.php';
        $this->setCacheFile($file);
    }

    /**
     * @param null|string $cacheFile
     */
    public function setCacheFile($cacheFile)
    {
        $this->cacheFile = $cacheFile;
    }

    public function readCache()
    {
        if ($this->isCached()) {
            /** @noinspection PhpIncludeInspection */
            include($this->cacheFile);

            /** @noinspection PhpUndefinedVariableInspection */
            if ($inflector) {
                foreach ($inflector as $type => $words) {
                    if ($words) {
                        foreach ($words as $word => $inflection) {
                            $this->dictionary[$type][$word] = $inflection;
                        }
                    }
                }
            }
        }
    }

    /**
     * @return bool
     */
    public function isCached()
    {
        if ($this->hasCacheFile()) {
            if (filemtime($this->cacheFile) + $this->getCacheTTL() > time()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function hasCacheFile()
    {
        return ($this->cacheFile && file_exists($this->cacheFile));
    }

    /**
     * @return int
     */
    public function getCacheTTL()
    {
        if (app()->has('config')) {
            $config = app()->get('config');
            if ($config->has('MISC.inflector_cache')) {
                return $config->get('MISC.inflector_cache');
            }
        }

        return 86400;
    }

    public function __destruct()
    {
        if ($this->toCache) {
            $this->writeCache();
        }
    }

    public function writeCache()
    {
        if ($this->dictionary && $this->cacheFile) {
            $file = new \Nip_File_Handler(["path" => $this->cacheFile]);
            $data = '<?php $inflector = ' . var_export($this->dictionary, true) . ";";
            $file->rewrite($data);
        }
    }
}
