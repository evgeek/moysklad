<?php

namespace Evgeek\Tests\Feature\Api\Builders\ById;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class ByIdCommonTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Builders\ById\ByIdCommon<extended>
     */
    public function testBuilder(): void
    {
        $testGuid = 'test_guid';
        $actual = $this->ms->entity()->product()->byId($testGuid)->debug()->get();
        $expected = $this->makeExpectedDebug(['entity', 'product', $testGuid]);

        $this->assertSame($expected, $actual);
    }
}
