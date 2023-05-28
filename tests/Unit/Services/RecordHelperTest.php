<?php

namespace Evgeek\Tests\Unit\Services;

use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\RecordHelper;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Services\RecordHelper */
class RecordHelperTest extends TestCase
{
    private MoySklad $ms;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ms = new MoySklad(['token']);
    }

    public function testObjectWithRowsIsCollection(): void
    {
        $this->assertTrue(RecordHelper::isCollection($this->ms, ['rows' => []]));
    }

    public function testObjectWithoutRowsIsNotCollection(): void
    {
        $this->assertFalse(RecordHelper::isCollection($this->ms, []));
    }
}
