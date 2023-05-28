<?php

namespace Evgeek\Tests\Feature\Api\Query\Builders\Methods\Nested;

use Evgeek\Tests\Feature\Api\Query\ApiTestCase;

class AttributesTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Query\Segments\Methods\Nested\AttributesSegment
     */
    public function testBuilder(): void
    {
        $this->assertCommonBuilderDebugSame('test_endpoint', 'test_method', ['attributes']);
    }
}
