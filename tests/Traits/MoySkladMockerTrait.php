<?php

namespace Evgeek\Tests\Traits;

use Evgeek\Moysklad\ApiObjects\Builders\ApiObjectBuilder;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Meta\MetaMaker;
use Evgeek\Moysklad\MoySklad;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/** @mixin TestCase */
trait MoySkladMockerTrait
{
    use ApiClientMockerTrait;

    protected MockObject|MoySklad $ms;

    protected function createMockMoySkladWithMockedApiClient(): void
    {
        $this->createMockApiClient();

        $this->ms = $this->createMock(MoySklad::class);
        $this->ms->method('getApiClient')->willReturn($this->api);
        $this->ms->method('meta')->willReturn(new MetaMaker(new ArrayFormat()));
        $this->ms->method('object')->willReturn(new ApiObjectBuilder($this->ms));
    }
}
