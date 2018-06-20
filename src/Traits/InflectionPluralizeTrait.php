<?php

namespace Nip\Inflector\Traits;

/**
 * Trait InflectionPluralizeTrait
 * @package Nip\Inflector\Traits
 *
 * @method pluralize($string)
 */
trait InflectionPluralizeTrait
{
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
}
