<?php

namespace Evgeek\Tests\Feature\Api\Query\Builders\ById;

use Evgeek\Tests\Feature\Api\Query\ApiTestCase;

class ByIdCommonTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Query\Segments\ById\ByIdSegmentCommon
     */
    public function testBuilder(): void
    {
        $testGuid = 'test_guid';
        $actual = $this->query->entity()->product()->byId($testGuid)->debug()->get();
        $expected = $this->makeExpectedDebug(['entity', 'product', $testGuid]);

        $this->assertSame($expected, $actual);
    }
}
