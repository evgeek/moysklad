<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\ApiObjects\Collections\Traits;

use Evgeek\Moysklad\ApiObjects\Collections\AbstractConcreteCollection;
use Evgeek\Tests\Traits\MoySkladMockerTrait;
use PHPUnit\Framework\TestCase;

abstract class CollectionTraitCase extends TestCase
{
    use MoySkladMockerTrait;

    public const PATH = ['endpoint', 'segment'];
    public const TYPE = 'entity';

    protected function setUp(): void
    {
        parent::setUp();

        $this->createMockMoySkladWithMockedApiClient();
    }

    protected function getTestCollection(): AbstractConcreteCollection
    {
        return new class($this->ms, []) extends AbstractConcreteCollection {
            public const PATH = CollectionTraitCase::PATH;
            public const TYPE = CollectionTraitCase::TYPE;
        };
    }
}
