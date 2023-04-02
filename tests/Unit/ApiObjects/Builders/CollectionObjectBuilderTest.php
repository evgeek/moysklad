<?php

namespace Evgeek\Tests\Unit\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Builders\CollectionObjectBuilder;
use Evgeek\Moysklad\ApiObjects\Collections\EmployeeCollection;
use Evgeek\Moysklad\ApiObjects\Collections\ProductCollection;
use Evgeek\Moysklad\Formatters\ApiObjectFormatter;
use Evgeek\Moysklad\Formatters\ApiObjectMapping;
use Evgeek\Moysklad\MoySklad;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\ApiObjects\Builders\AbstractObjectBuilder
 * @covers \Evgeek\Moysklad\ApiObjects\Builders\CollectionObjectBuilder
 */
class CollectionObjectBuilderTest extends ObjectResolversTestCase
{
    private CollectionObjectBuilder $builder;

    protected function setUp(): void
    {
        $this->builder = new CollectionObjectBuilder(new MoySklad(['token']));
    }

    public function testResolvingUnregisteredCollectionThrowsException(): void
    {
        $mapping = new ApiObjectMapping([], []);
        $ms = new MoySklad(['token'], new ApiObjectFormatter($mapping));
        $builder = new CollectionObjectBuilder($ms);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Collection type 'product' has no mapped class");

        $builder->product();
    }

    public function testProductMethod(): void
    {
        $product = $this->builder->product(static::CONTENT);

        $this->assertObjectResolvedWithExpectedMetaAndContent($product, ProductCollection::class);
    }

    public function testEmployeeMethod(): void
    {
        $product = $this->builder->employee(static::CONTENT);

        $this->assertObjectResolvedWithExpectedMetaAndContent($product, EmployeeCollection::class);
    }
}
