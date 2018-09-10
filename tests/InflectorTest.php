<?php

namespace Nip\Inflector\Tests;

use Nip\Inflector\Inflector;

/**
 * Class InflectorTest
 * @package Nip\Tests\Inflector
 */
class InflectorTest extends AbstractTest
{

    /**
     * @var Inflector
     */
    protected $inflector;

    /**
     * @return array
     */
    public function providerURLController()
    {
        return [
            ['user_groups', 'UserGroupsController'],
            ['async-user_groups', 'Async_UserGroupsController'],
            ['modal-users', 'Modal_UsersController'],
            ['modal-users', 'Modal_UsersController'],
            ['users', 'UsersController'],
        ];
    }

    /**
     * @dataProvider providerClassTable
     * @param $table
     * @param $class
     */
    public function testClassToTable($table, $class)
    {
        self::assertEquals($table, $this->inflector->unclassify($class));
    }

    /**
     * @dataProvider providerURLController
     * @param $url
     * @param $controller
     */
    public function testURLToController($url, $controller)
    {
        self::assertEquals($controller, $this->inflector->classify($url) . "Controller");
    }

    /**
     * @dataProvider providerURLController
     * @param $url
     * @param $controller
     */
    public function testControllerToURL($url, $controller)
    {
        $class = str_replace("Controller", "", $controller);
        self::assertEquals($url, $this->inflector->unclassify($class));
    }

    public function testPluralize()
    {
        self::assertEquals("mice", $this->inflector->pluralize("mouse"));
        self::assertEquals("people", $this->inflector->pluralize("person"));
        self::assertEquals("scos", $this->inflector->pluralize("sco"));
        self::assertEquals("statuses", $this->inflector->pluralize("status"));
        self::assertEquals("companies", $this->inflector->pluralize("company"));
        self::assertEquals("companies", $this->inflector->pluralize("companies"));
    }

    protected function setUp()
    {
        parent::setUp();
        $this->inflector = new Inflector();
    }
}
