<?php

namespace Evgeek\Tests\Unit;

use Evgeek\Moysklad\Api\Builder;
use Evgeek\Moysklad\Api\Query;
use Evgeek\Moysklad\MoySklad;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\MoySklad */
class MoySkladTest extends TestCase
{
    public function testQuery(): void
    {
        $ms = new MoySklad(['token']);
        $query = $ms->query();

        $this->assertInstanceOf(Query::class, $query);
        $this->assertInstanceOf(Builder::class, $query);
    }
}
