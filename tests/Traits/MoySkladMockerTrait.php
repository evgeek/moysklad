<?php

namespace Evgeek\Tests\Traits;

use Evgeek\Moysklad\Api\Record\Builders\RecordBuilder;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Meta\MetaBuilder;
use Evgeek\Moysklad\MoySklad;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/** @mixin TestCase */
trait MoySkladMockerTrait
{
    use ApiClientMockerTrait;

    protected MockObject|MoySklad $ms;

    protected function createMockMoySkladWithMockedApiClient(): MockObject|MoySklad
    {
        $this->createMockApiClient();

        $this->ms = $this->createMock(MoySklad::class);
        $this->ms->method('getApiClient')->willReturn($this->api);
        $this->ms->method('meta')->willReturn(new MetaBuilder(new ArrayFormat()));
        $this->ms->method('record')->willReturn(new RecordBuilder($this->ms));
        $this->ms->method('getFormatter')->willReturn(new ArrayFormat());

        return $this->ms;
    }
}
