<?php

namespace Evgeek\Tests\Feature\Api\Builders\Methods\Nested;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class MetadataTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Builders\Methods\Nested\Metadata<extended>
     */
    public function testBuilder(): void
    {
        $this->assertCommonBuilderDebugSame('test_endpoint', 'test_method', ['metadata']);
    }
}
