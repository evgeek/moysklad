<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Objects\Traits;

use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Tests\Traits\MoySkladMockerTrait;
use PHPUnit\Framework\TestCase;

abstract class ObjectTraitCase extends TestCase
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

    protected function getTestObject(array $content = []): AbstractConcreteObject
    {
        return new class($this->ms, $content) extends AbstractConcreteObject {
            public const PATH = CrudObjectTraitTest::PATH;
            public const TYPE = CrudObjectTraitTest::TYPE;
        };
    }
}
