<?php

namespace Nip\Inflector;

use Nip\Inflector\Traits\HasCacheTrait;
use Nip\Inflector\Traits\HasDictionaryTrait;
use Nip\Inflector\Traits\InflectionCamelizeTrait;
use Nip\Inflector\Traits\InflectionClassifyTrait;
use Nip\Inflector\Traits\InflectionHyphenizeTrait;
use Nip\Inflector\Traits\InflectionOrdinalizeTrait;
use Nip\Inflector\Traits\InflectionPluralizeTrait;
use Nip\Inflector\Traits\InflectionSingularizeTrait;
use Nip\Inflector\Traits\InflectionTableizeTrait;
use Nip\Inflector\Traits\InflectionUnclasifyTrait;
use Nip\Inflector\Traits\InflectionUnderscoreTrait;
use Nip\Inflector\Traits\MagicMethodsTrait;

/**
 * Class Inflector
 * @package Nip\Inflector
 * @based on https://github.com/cakephp/cakephp/blob/master/src/Utility/Inflector.php
 */
class Inflector
{
    use HasCacheTrait;
    use HasDictionaryTrait;
    use MagicMethodsTrait;
    use InflectionCamelizeTrait;
    use InflectionClassifyTrait;
    use InflectionHyphenizeTrait;
    use InflectionOrdinalizeTrait;
    use InflectionPluralizeTrait;
    use InflectionSingularizeTrait;
    use InflectionTableizeTrait;
    use InflectionUnclasifyTrait;
    use InflectionUnderscoreTrait;

    /**
     * @param $name
     * @return bool
     */
    public function hasInflection($name)
    {
        $method = $this->inflectionMethod($name);
        return method_exists($this, $method);
    }

    /**
     * @param $name
     * @param $word
     * @return mixed
     */
    public function doInflection($name, $word)
    {
        if (!self::hasString($name, $word)) {
            $method = $this->inflectionMethod($name);
            self::setString($name, $word, $this->$method($word));
        }

        return self::getString($name, $word);
    }

    /**
     * @param $name
     * @return string
     */
    protected function inflectionMethod($name)
    {
        return "do" . ucfirst($name);
    }
}
