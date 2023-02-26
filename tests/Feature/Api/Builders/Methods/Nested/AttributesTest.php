<?php

namespace Evgeek\Tests\Feature\Api\Builders\Methods\Nested;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class AttributesTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Segments\Methods\Nested\Attributes<extended>
     */
    public function testBuilder(): void
    {
        $this->assertCommonBuilderDebugSame('test_endpoint', 'test_method', ['attributes']);
    }
}
