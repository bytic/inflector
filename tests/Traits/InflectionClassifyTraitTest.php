<?php

namespace Nip\Inflector\Tests\Traits;

use Nip\Inflector\Inflector;
use Nip\Inflector\Tests\AbstractTest;

/**
 * Class InflectorTest
 * @package Nip\Tests\Inflector
 */
class InflectionClassifyTraitTest extends AbstractTest
{


    /**
     * @dataProvider providerClassTable
     * @param $table
     * @param $class
     */
    public function testTableToClass($table, $class)
    {
        self::assertEquals($class, $this->inflector->classify($table));
    }

    /**
     * @var Inflector
     */
    protected $inflector;

    protected function setUp() : void
    {
        parent::setUp();

        $this->inflector = new Inflector();
    }
}
