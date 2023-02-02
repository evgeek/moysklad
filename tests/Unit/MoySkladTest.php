<?php

namespace Evgeek\Tests\Unit;

use Evgeek\Moysklad\Api\Builders\Builder;
use Evgeek\Moysklad\Api\Builders\Query;
use Evgeek\Moysklad\MoySklad;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\MoySklad */
class MoySkladTest extends TestCase
{
    public function testQuery(): void
    {
        $ms = new MoySklad(['token']);

        $this->assertInstanceOf(Builder::class, $ms->query());
    }
}
