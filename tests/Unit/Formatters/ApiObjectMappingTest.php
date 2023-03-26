<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\Formatters\ApiObjectMapping;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Evgeek\Moysklad\Formatters\ApiObjectMapping
 */
class ApiObjectMappingTest extends TestCase
{
    private ApiObjectMapping $mapping;

    protected function setUp(): void
    {
        $this->mapping = new ApiObjectMapping();
    }
}
