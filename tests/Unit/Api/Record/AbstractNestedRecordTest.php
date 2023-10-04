<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record;

use Evgeek\Moysklad\Api\Record\AbstractConcreteRecord;
use Evgeek\Moysklad\Api\Record\AbstractNestedRecord;
use Evgeek\Moysklad\Api\Record\AbstractUnknownRecord;
use Evgeek\Moysklad\Api\Record\Collections\Traits\FillMetaCollectionTrait;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
use Evgeek\Moysklad\Formatters\ArrayFormat;
use Evgeek\Moysklad\Formatters\RecordFormat;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use Evgeek\Moysklad\Tools\Meta;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Record\AbstractNestedRecord
 * @covers \Evgeek\Moysklad\Api\Record\AbstractRecord
 */
class AbstractNestedRecordTest extends TestCase
{
    private const CONTENT = [
        'key' => 'value',
        'array_key' => ['inner_key' => 'inner_value'],
    ];
    protected const GUID = '25cf41f2-b068-11ed-0a80-0e9700500d7e';

    public function testObjectResolvedFromArrayParent(): void
    {
        $nestedObject = $this->getNestedObject(['endpoint', 'segment']);

        $this->assertSame(Url::API . '/endpoint/segment/nested_path_1/nested_path_2', $nestedObject->meta->href);
        $this->assertSame('value', $nestedObject->key);
        $this->assertSame('inner_value', $nestedObject->array_key->inner_key);
    }

    public function testObjectResolvedFromObjectParent(): void
    {
        $nestedObject = $this->getNestedObject(new Product(new MoySklad(['token']), ['id' => self::GUID]));

        $this->assertSame(Url::API . '/entity/product/' . self::GUID . '/nested_path_1/nested_path_2', $nestedObject->meta->href);
        $this->assertSame('value', $nestedObject->key);
        $this->assertSame('inner_value', $nestedObject->array_key->inner_key);
    }

    private function getNestedObject(ObjectInterface|array|string $parent): AbstractNestedRecord
    {
        return new class(new MoySklad(['token']), $parent, self::CONTENT) extends AbstractNestedRecord {
            use FillMetaCollectionTrait;

            public const PATH = ['nested_path_1', 'nested_path_2'];
            public const TYPE = 'unknown-type';
        };
    }
}
