<?php

namespace Evgeek\Tests\Unit\Api;

use Evgeek\Tests\Traits\ApiClientMockerTrait;
use PHPUnit\Framework\TestCase;

abstract class ApiTestCase extends TestCase
{
    use ApiClientMockerTrait;

    protected const PREV_PATH = [
        'test_endpoint',
        'test_method',
    ];
    protected const PARAMS = [
        'limit=1',
        'archived=false',
    ];
    protected const BODY = [
        'name' => 'tangerine',
        'code' => '123456',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        $this->createMockApiClient();
    }
}
