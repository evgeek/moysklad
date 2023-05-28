<?php

namespace Evgeek\Tests\Unit\Api\Record\Builders;

use Evgeek\Moysklad\Api\Record\Builders\CollectionBuilder;
use Evgeek\Moysklad\Api\Record\Collections\Documents\CustomerorderCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\AssortmentCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Formatters\RecordFormatter;
use Evgeek\Moysklad\Formatters\RecordMapping;
use Evgeek\Moysklad\MoySklad;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Builders\AbstractBuilder
 * @covers \Evgeek\Moysklad\Api\Record\Builders\CollectionBuilder
 */
class CollectionBuilderTest extends RecordResolversTestCase
{
    private CollectionBuilder $builder;

    protected function setUp(): void
    {
        $this->builder = new CollectionBuilder(new MoySklad(['token']));
    }

    public function testResolvingUnregisteredCollectionThrowsException(): void
    {
        $mapping = new RecordMapping([], []);
        $ms = new MoySklad(['token'], new RecordFormatter($mapping));
        $builder = new CollectionBuilder($ms);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Collection type 'product' has no mapped class");

        $builder->product();
    }

    public function testUnknownMethod(): void
    {
        $path = ['endpoint', 'segment'];
        $type = 'unknown_type';
        $unknown = $this->builder->unknown($path, $type);

        $this->assertObjectResolvedWithExpectedMetaAndContent($unknown, UnknownCollection::class, $path, $type);
    }

    public function testProductMethod(): void
    {
        $product = $this->builder->product();

        $this->assertObjectResolvedWithExpectedMetaAndContent($product, ProductCollection::class);
    }

    public function testEmployeeMethod(): void
    {
        $product = $this->builder->employee();

        $this->assertObjectResolvedWithExpectedMetaAndContent($product, EmployeeCollection::class);
    }

    public function testAssortmentMethod(): void
    {
        $product = $this->builder->assortment();

        $this->assertObjectResolvedWithExpectedMetaAndContent($product, AssortmentCollection::class);
    }

    public function testCustomerorderMethod(): void
    {
        $product = $this->builder->customerorder();

        $this->assertObjectResolvedWithExpectedMetaAndContent($product, CustomerorderCollection::class);
    }
}
