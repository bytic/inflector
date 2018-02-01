<?php

namespace Nip\Inflector;

use Nip\Inflector\Traits\HasCacheTrait;

/**
 * Class Inflector
 * @package Nip\Inflector
 * @based on https://github.com/cakephp/cakephp/blob/master/src/Utility/Inflector.php
 */
class Inflector
{
    use HasCacheTrait;

    protected $plural = [
        '/(s)tatus$/i' => '\1tatuses',
        '/(quiz)$/i' => '\1zes',
        '/^(ox)$/i' => '\1\2en',
        '/([m|l])ouse$/i' => '\1ice',
        '/(matr|vert|ind)(ix|ex)$/i' => '\1ices',
        '/(x|ch|ss|sh)$/i' => '\1es',
        '/([^aeiouy]|qu)y$/i' => '\1ies',
        '/(hive)$/i' => '\1s',
        '/(chef)$/i' => '\1s',
        '/(?:([^f])fe|([lre])f)$/i' => '\1\2ves',
        '/sis$/i' => 'ses',
        '/([ti])um$/i' => '\1a',
        '/(p)erson$/i' => '\1eople',
        '/(?<!u)(m)an$/i' => '\1en',
        '/(c)hild$/i' => '\1hildren',
        '/(buffal|tomat)o$/i' => '\1\2oes',
        '/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin)us$/i' => '\1i',
        '/us$/i' => 'uses',
        '/(alias)$/i' => '\1es',
        '/(ax|cris|test)is$/i' => '\1es',
        '/s$/' => 's',
        '/^$/' => '',
        '/$/' => 's',
    ];
    protected $singular = [
        '/(s)tatuses$/i' => '\1\2tatus',
        '/^(.*)(menu)s$/i' => '\1\2',
        '/(quiz)zes$/i' => '\\1',
        '/(matr)ices$/i' => '\1ix',
        '/(vert|ind)ices$/i' => '\1ex',
        '/^(ox)en/i' => '\1',
        '/(alias)(es)*$/i' => '\1',
        '/(alumn|bacill|cact|foc|fung|nucle|radi|stimul|syllab|termin|viri?)i$/i' => '\1us',
        '/([ftw]ax)es/i' => '\1',
        '/(cris|ax|test)es$/i' => '\1is',
        '/(shoe)s$/i' => '\1',
        '/(o)es$/i' => '\1',
        '/ouses$/' => 'ouse',
        '/([^a])uses$/' => '\1us',
        '/([m|l])ice$/i' => '\1ouse',
        '/(x|ch|ss|sh)es$/i' => '\1',
        '/(m)ovies$/i' => '\1\2ovie',
        '/(s)eries$/i' => '\1\2eries',
        '/([^aeiouy]|qu)ies$/i' => '\1y',
        '/(tive)s$/i' => '\1',
        '/(hive)s$/i' => '\1',
        '/(drive)s$/i' => '\1',
        '/([le])ves$/i' => '\1f',
        '/([^rfoa])ves$/i' => '\1fe',
        '/(^analy)ses$/i' => '\1sis',
        '/(analy|diagno|^ba|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => '\1\2sis',
        '/([ti])a$/i' => '\1um',
        '/(p)eople$/i' => '\1\2erson',
        '/(m)en$/i' => '\1an',
        '/(c)hildren$/i' => '\1\2hild',
        '/(n)ews$/i' => '\1\2ews',
        '/eaus$/' => 'eau',
        '/^(.*us)$/' => '\\1',
        '/s$/i' => ''
    ];
    protected $uncountable = [
        '.*[nrlm]ese',
        '.*data',
        '.*deer',
        '.*fish',
        '.*measles',
        '.*ois',
        '.*pox',
        '.*sheep',
        'people',
        'feedback',
        'stadia',
        '.*?media',
        'chassis',
        'clippers',
        'debris',
        'diabetes',
        'equipment',
        'gallows',
        'graffiti',
        'headquarters',
        'information',
        'innings',
        'news',
        'nexus',
        'pokemon',
        'proceedings',
        'research',
        'sea[- ]bass',
        'series',
        'species',
        'weather'
    ];
    protected $irregular = [
        'atlas' => 'atlases',
        'beef' => 'beefs',
        'brief' => 'briefs',
        'brother' => 'brothers',
        'cafe' => 'cafes',
        'child' => 'children',
        'cookie' => 'cookies',
        'corpus' => 'corpuses',
        'cow' => 'cows',
        'criterion' => 'criteria',
        'ganglion' => 'ganglions',
        'genie' => 'genies',
        'genus' => 'genera',
        'graffito' => 'graffiti',
        'hoof' => 'hoofs',
        'loaf' => 'loaves',
        'man' => 'men',
        'money' => 'monies',
        'mongoose' => 'mongooses',
        'move' => 'moves',
        'mythos' => 'mythoi',
        'niche' => 'niches',
        'numen' => 'numina',
        'occiput' => 'occiputs',
        'octopus' => 'octopuses',
        'opus' => 'opuses',
        'ox' => 'oxen',
        'penis' => 'penises',
        'person' => 'people',
        'sex' => 'sexes',
        'soliloquy' => 'soliloquies',
        'testis' => 'testes',
        'trilby' => 'trilbys',
        'turf' => 'turfs',
        'potato' => 'potatoes',
        'hero' => 'heroes',
        'tooth' => 'teeth',
        'goose' => 'geese',
        'foot' => 'feet',
        'foe' => 'foes',
        'sieve' => 'sieves'
    ];

    protected $dictionary;

    /**
     * Inflector constructor.
     */
    public function __construct()
    {
    }


    /**
     * @param $word
     * @return mixed
     */
    public function unclassify($word)
    {
        return $this->doInflection('unclassify', $word);
    }

    /**
     * @param $name
     * @param $word
     * @return mixed
     */
    public function doInflection($name, $word)
    {
        if (!isset($this->dictionary[$name][$word])) {
            $this->toCache = true;
            $method = "do" . ucfirst($name);
            $this->dictionary[$name][$word] = $this->$method($word);
        }

        return $this->dictionary[$name][$word];
    }

    /**
     * @param $word
     * @return mixed
     */
    public function singularize($word)
    {
        return $this->doInflection('singularize', $word);
    }

    /**
     * @param $word
     * @return mixed
     */
    public function camelize($word)
    {
        return $this->doInflection('camelize', $word);
    }

    /**
     * @param $word
     * @return mixed
     */
    public function classify($word)
    {
        return $this->doInflection('classify', $word);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $word = $arguments[0];

        return $this->doInflection($name, $word);
    }

    /**
     * @param $word
     * @return bool|mixed
     */
    protected function doPluralize($word)
    {
        $lowerCased_word = strtolower($word);

        foreach ($this->uncountable as $_uncountable) {
            if (substr($lowerCased_word, (-1 * strlen($_uncountable))) == $_uncountable) {
                return $word;
            }
        }

        foreach ($this->irregular as $_plural => $_singular) {
            if (preg_match('/(' . $_plural . ')$/i', $word, $arr)) {
                return preg_replace('/(' . $_plural . ')$/i', substr($arr[0], 0, 1) . substr($_singular, 1), $word);
            }
        }

        foreach ($this->plural as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                return preg_replace($rule, $replacement, $word);
            }
        }

        return false;
    }

    /**
     * @param $word
     * @return mixed
     */
    protected function doSingularize($word)
    {
        $lowercased_word = strtolower($word);
        foreach ($this->uncountable as $_uncountable) {
            if (substr($lowercased_word, (-1 * strlen($_uncountable))) == $_uncountable) {
                return $word;
            }
        }

        foreach ($this->irregular as $_plural => $_singular) {
            if (preg_match('/(' . $_singular . ')$/i', $word, $arr)) {
                return preg_replace('/(' . $_singular . ')$/i', substr($arr[0], 0, 1) . substr($_plural, 1), $word);
            }
        }

        foreach ($this->singular as $rule => $replacement) {
            if (preg_match($rule, $word)) {
                return preg_replace($rule, $replacement, $word);
            }
        }

        return $word;
    }

    /**
     * @param $word
     * @return string
     */
    protected function doCamelize($word)
    {
        return str_replace(' ', '', ucwords(preg_replace('/[^A-Z^a-z^0-9]+/', ' ', $word)));
    }

    /**
     * @param $word
     * @return string
     */
    protected function doHyphenize($word)
    {
        $word = $this->doUnderscore($word);

        return str_replace('_', '-', $word);
    }

    /**
     * @param $word
     * @return string
     */
    protected function doUnderscore($word)
    {
        return strtolower(preg_replace('/[^A-Z^a-z^0-9]+/', '_',
            preg_replace('/([a-zd])([A-Z])/', '\1_\2', preg_replace('/([A-Z]+)([A-Z][a-z])/', '\1_\2', $word))));
    }

    /**
     * Converts a class name to its table name according to rails
     * naming conventions.
     *
     * Converts "Person" to "people"
     *
     * @param string $class_name Class name for getting related table_name.
     * @return string plural_table_name
     */
    protected function doTableize($class_name)
    {
        return $this->pluralize($this->underscore($class_name));
    }

    /**
     * @param $word
     * @return string
     */
    public function pluralize($word)
    {
        return $this->doInflection('pluralize', $word);
    }

    /**
     * @param $word
     * @return mixed
     */
    public function underscore($word)
    {
        return $this->doInflection('underscore', $word);
    }

    /**
     * Converts lowercase string to underscored camelize class format
     *
     * @param string $string
     * @return string
     */
    protected function doClassify($string)
    {
        $parts = explode("-", $string);
        $parts = array_map([$this, "camelize"], $parts);

        return implode("_", $parts);
    }

    /**
     * Reverses classify()
     *
     * @param string $string
     * @return string
     */
    protected function doUnclassify($string)
    {
        $string = str_replace('\\', '_', $string);
        $parts = explode("_", $string);
        $parts = array_map([$this, "underscore"], $parts);

        return implode("-", $parts);
    }

    /**
     * @param $number
     * @return string
     */
    protected function doOrdinalize($number)
    {
        if (in_array(($number % 100), range(11, 13))) {
            return $number . 'th';
        } else {
            switch (($number % 10)) {
                case 1:
                    return $number . 'st';
                    break;
                case 2:
                    return $number . 'nd';
                    break;
                case 3:
                    return $number . 'rd';
                default:
                    return $number . 'th';
                    break;
            }
        }
    }
}
