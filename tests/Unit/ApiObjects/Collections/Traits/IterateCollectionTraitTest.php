<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\ApiObjects\Collections\Traits;

use Evgeek\Moysklad\ApiObjects\Objects\Product;
use Evgeek\Moysklad\Http\Payload;
use Evgeek\Moysklad\Services\Url;
use RuntimeException;

/**
 * @covers \Evgeek\Moysklad\ApiObjects\Collections\Traits\IterateCollectionTrait
 */
class IterateCollectionTraitTest extends CollectionTraitCase
{
    public function testEachCorrectIterateRows(): void
    {
        $objects = [
            $this->ms->object()->single()->product(['id' => static::GUID, 'name' => 'product1']),
            $this->ms->object()->single()->product(['id' => static::GUID, 'name' => 'product2']),
            $this->ms->object()->single()->product(['id' => static::GUID, 'name' => 'product3']),
        ];
        $collection = $this->getTestCollection(['rows' => $objects]);

        $counter = 0;
        $collection->each(function (Product $product) use (&$counter) {
            ++$counter;
            $this->assertSame("product$counter", $product->name);
        });

        $this->assertSame(3, $counter);
    }

    public function testEachGeneratorCallsApiAsExpected(): void
    {
        $meta = $this->ms->meta()->create(static::PATH, static::TYPE);
        [$path, $params] = Url::parsePathAndParams($meta['href']);
        $meta['nextHref'] = Url::makeFromPathAndParams($path, ['limit' => 2, 'offset' => 2]);
        $this->api
            ->expects($this->exactly(2))
            ->method('send')
            ->willReturnCallback(fn (Payload $payload) => match (true) {
                $payload->params === ['limit' => '2', 'offset' => '0'] => [
                    'meta' => $meta,
                    'rows' => [
                        $this->ms->object()->single()->product(['id' => static::GUID, 'name' => 'product1']),
                        $this->ms->object()->single()->product(['id' => static::GUID, 'name' => 'product2']),
                    ],
                ],
                $payload->params === ['limit' => '2', 'offset' => '2'] => [
                    'rows' => [
                        $this->ms->object()->single()->product(['id' => static::GUID, 'name' => 'product3']),
                    ],
                ],
                default => throw new RuntimeException('Incorrect payload')
            });
        $this->createMockApiClient();

        $collection = $this->getTestCollection()->limit(2)->offset(0);

        $counter = 0;
        $collection->eachGenerator(function (Product $product) use (&$counter) {
            ++$counter;
            $this->assertSame("product$counter", $product->name);
        });

        $this->assertSame(3, $counter);
    }
}
