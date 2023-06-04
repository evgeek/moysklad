<?php

namespace Evgeek\Tests\Feature\Api\Query\Builders\ById;

use Evgeek\Tests\Feature\Api\Query\ApiTestCase;

class ByIdPositionedTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Query\Segments\ById\ByIdSegmentPositioned
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
