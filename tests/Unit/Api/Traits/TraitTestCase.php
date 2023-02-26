<?php

namespace Evgeek\Tests\Unit\Api\Traits;

use Evgeek\Tests\Unit\Api\ApiTestCase;

abstract class TraitTestCase extends ApiTestCase
{
    protected const SEGMENT = 'test_segment';
    protected const PATH = [
        ...self::PREV_PATH,
        self::SEGMENT,
    ];
}
