<?php

namespace Evgeek\Tests\Feature\Api\Builders\Methods\Nested;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class PositionsTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Segments\Methods\Nested\Positions<extended>
     */
    public function testBuilder(): void
    {
        $this->assertCommonBuilderDebugSame('test_endpoint', 'test_method', ['positions']);
    }
}
