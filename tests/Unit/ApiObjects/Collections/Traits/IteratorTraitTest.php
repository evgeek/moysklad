<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\ApiObjects\Collections\Traits;

/**
 * @covers \Evgeek\Moysklad\ApiObjects\Collections\Traits\IteratorTrait
 */
class IteratorTraitTest extends CollectionTraitCase
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
        foreach ($collection as $product) {
            $this->assertSame($counter, $collection->key());
            ++$counter;
            $this->assertSame("product$counter", $product->name);
        }

        $this->assertSame(3, $counter);
    }
}
