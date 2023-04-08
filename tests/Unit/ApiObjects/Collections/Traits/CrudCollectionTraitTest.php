<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\ApiObjects\Collections\Traits;

use Evgeek\Moysklad\Enums\HttpMethod;

/**
 * @covers \Evgeek\Moysklad\ApiObjects\Collections\Traits\CrudCollectionTrait
 */
class CrudCollectionTraitTest extends CollectionTraitCase
{
    public function testGetMethodCallsSendWithExpectedParams(): void
    {
        $collection = $this->getTestCollection();
        $this->expectsSendCalledWith(HttpMethod::GET, self::PATH, [], []);

        $collection->get();
    }
}
