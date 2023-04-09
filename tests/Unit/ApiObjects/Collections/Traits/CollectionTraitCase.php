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
    protected const GUID = '25cf41f2-b068-11ed-0a80-0e9700500d7e';

    protected function setUp(): void
    {
        parent::setUp();

        $this->createMockMoySkladWithMockedApiClient();
    }

    protected function getTestCollection(array $content = []): AbstractConcreteCollection
    {
        return new class($this->ms, $content) extends AbstractConcreteCollection {
            public const PATH = CollectionTraitCase::PATH;
            public const TYPE = CollectionTraitCase::TYPE;
        };
    }
}
