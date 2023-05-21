<?php

namespace Evgeek\Tests\Unit\Services;

use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\ApiObjectHelper;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Services\ApiObjectHelper */
class ApiObjectHelperTest extends TestCase
{
    private MoySklad $ms;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ms = new MoySklad(['token']);
    }

    public function testObjectWithRowsIsCollection(): void
    {
        $this->assertTrue(ApiObjectHelper::isCollection($this->ms, ['rows' => []]));
    }

    public function testObjectWithoutRowsIsNotCollection(): void
    {
        $this->assertFalse(ApiObjectHelper::isCollection($this->ms, []));
    }
}
