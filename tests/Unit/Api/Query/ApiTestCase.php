<?php

namespace Evgeek\Tests\Unit\Api\Query;

use Evgeek\Tests\Traits\ApiClientMockerTrait;
use PHPUnit\Framework\TestCase;

abstract class ApiTestCase extends TestCase
{
    use ApiClientMockerTrait;

    protected const GUID = '25cf41f2-b068-11ed-0a80-0e9700500d7e';
    protected const PREV_PATH = [
        'test_endpoint',
        'test_method',
    ];
    protected const PARAMS = [
        'test_param_1' => 1,
        'test_param_2' => true,
        'test_param_3' => 'string',
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
