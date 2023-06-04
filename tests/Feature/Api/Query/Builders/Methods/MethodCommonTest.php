<?php

namespace Evgeek\Tests\Feature\Api\Query\Builders\Methods;

use Evgeek\Tests\Feature\Api\Query\ApiTestCase;

class MethodCommonTest extends ApiTestCase
{
    /**
     * @covers \Evgeek\Moysklad\Api\Query\Segments\Methods\MethodSegmentCommon
     */
    public function testBuilder(): void
    {
        $this->assertCommonBuilderDebugSame('test_endpoint', 'test_method');
    }
}
