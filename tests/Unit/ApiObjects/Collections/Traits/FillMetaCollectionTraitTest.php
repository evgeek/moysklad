<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\ApiObjects\Collections\Traits;

use Evgeek\Moysklad\Services\Url;

/**
 * @covers \Evgeek\Moysklad\ApiObjects\Collections\Traits\FillMetaCollectionTrait
 */
class FillMetaCollectionTraitTest extends CollectionTraitCase
{
    public function testExistingMetaIsPreserved(): void
    {
        $meta = ['random_key' => 'random_value'];
        $collection = $this->getTestCollection(['meta' => $meta]);

        $this->assertSame($meta, $collection->toArray()['meta']);
    }

    public function testNotExistingMetaMakesFromPathAndType(): void
    {
        $collection = $this->getTestCollection();
        $expectedMeta = [
            'href' => Url::API . '/' . implode('/', static::PATH),
            'type' => static::TYPE,
            'mediaType' => 'application/json',
        ];

        $this->assertSame($expectedMeta, $collection->toArray()['meta']);
    }
}
