<?php

namespace Evgeek\Tests\Feature\Api\Builders\ById;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class ByIdPositionedTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Builders\ById\ByIdPositioned<extended>
     */
    public function testBuilder(): void
    {
        $testGuidFirst = 'test_guid_first';
        $testGuidSecond = 'test_guid_second';
        $actual = $this->query->entity()->customerorder()->byId($testGuidFirst)->positions()->byId($testGuidSecond)->debug()->get();
        $expected = $this->makeExpectedDebug(['entity', 'customerorder', $testGuidFirst, 'positions', $testGuidSecond]);

        $this->assertSame($expected, $actual);
    }
}
