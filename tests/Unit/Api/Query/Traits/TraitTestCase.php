<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits;

use Evgeek\Tests\Unit\Api\Query\ApiTestCase;

abstract class TraitTestCase extends ApiTestCase
{
    protected const SEGMENT = 'test_segment';
    protected const PATH = [
        ...self::PREV_PATH,
        self::SEGMENT,
    ];
}
