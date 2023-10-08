<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Tests\Traits\MoySkladMockerTrait;
use PHPUnit\Framework\TestCase;

abstract class CollectionTraitCase extends TestCase
{
    use MoySkladMockerTrait;

    public const PATH = ['endpoint', 'segment'];
    public const TYPE = 'entity';
    protected const GUID1 = '25cf41f2-b068-11ed-0a80-0e9700500d7e';
    protected const GUID2 = '161d25a8-1477-11ec-ac18-000b00000002';

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
