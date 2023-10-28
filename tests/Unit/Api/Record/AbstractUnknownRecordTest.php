<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record;

use Evgeek\Moysklad\Api\Record\AbstractUnknownRecord;
use Evgeek\Moysklad\Api\Record\Collections\Traits\FillMetaCollectionTrait;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Record\AbstractRecord
 * @covers \Evgeek\Moysklad\Api\Record\AbstractUnknownRecord
 */
class AbstractUnknownRecordTest extends TestCase
{
    public function testEmptyPathThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('path and type cannot be empty');

        $this->getInvalidUnknownObject([], 'type');
    }

    public function testEmptyTypeThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('path and type cannot be empty');

        $this->getInvalidUnknownObject(['path'], '');
    }

    public function testValidUnknownObjectResolvedCorrectly(): void
    {
        $unknownObject = new class(new MoySklad(['token']), ['endpoint', 'segment'], 'unknown-type', ['key' => 'value']) extends AbstractUnknownRecord {
            use FillMetaCollectionTrait;
        };

        $this->assertSame(Url::API . '/endpoint/segment', $unknownObject->meta->href);
        $this->assertSame('unknown-type', $unknownObject->meta->type);
        $this->assertSame('value', $unknownObject->key);
    }

    private function getInvalidUnknownObject(array $path, string $type): void
    {
        new class(new MoySklad(['token']), $path, $type, []) extends AbstractUnknownRecord {
            use FillMetaCollectionTrait;
        };
    }
}
