<?php

namespace Evgeek\Tests\Feature\Api\Builders\Methods;

use Evgeek\Tests\Feature\Api\ApiTestCase;

class MethodCommonTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Segments\Methods\MethodSegmentCommon
     */
    public function testBuilder(): void
    {
        $this->assertCommonBuilderDebugSame('test_endpoint', 'test_method');
    }
}
