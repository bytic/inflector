<?php

namespace Nip\Inflector\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTest
 */
abstract class AbstractTest extends TestCase
{
    protected $object;

    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @return array
     */
    public function providerClassTable()
    {
        return [
            ["users", "Users"],
            ["user_groups", "UserGroups"],
            ["acl-permissions", "Acl_Permissions"],
            ["user_groups-users", "UserGroups_Users"],
            ["user_groups\Users", "UserGroups\Users"],
        ];
    }
}
