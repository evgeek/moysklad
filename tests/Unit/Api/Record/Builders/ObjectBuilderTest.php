<?php

namespace Evgeek\Tests\Unit\Api\Record\Builders;

use Evgeek\Moysklad\Api\Record\Builders\ObjectBuilder;
use Evgeek\Moysklad\Api\Record\Objects\Documents\Customerorder;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Employee;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Formatters\RecordFormatter;
use Evgeek\Moysklad\Formatters\RecordMapping;
use Evgeek\Moysklad\MoySklad;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Builders\AbstractBuilder
 * @covers \Evgeek\Moysklad\Api\Record\Builders\ObjectBuilder
 */
class ObjectBuilderTest extends RecordResolversTestCase
{
    private ObjectBuilder $builder;

    protected function setUp(): void
    {
        $this->builder = new ObjectBuilder(new MoySklad(['token']));
    }

    public function testResolvingUnregisteredObjectThrowsException(): void
    {
        $mapping = new RecordMapping([], []);
        $ms = new MoySklad(['token'], new RecordFormatter($mapping));
        $builder = new ObjectBuilder($ms);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Object type 'product' has no mapped class");

        $builder->product();
    }

    public function testProductMethod(): void
    {
        $product = $this->builder->product(static::CONTENT);

        $this->assertObjectResolvedWithExpectedMetaAndContent($product, Product::class);
    }

    public function testEmployeeMethod(): void
    {
        $product = $this->builder->employee(static::CONTENT);

        $this->assertObjectResolvedWithExpectedMetaAndContent($product, Employee::class);
    }

    public function testCustomerorderMethod(): void
    {
        $product = $this->builder->customerorder(static::CONTENT);

        $this->assertObjectResolvedWithExpectedMetaAndContent($product, Customerorder::class);
    }

    public function testUnknownMethod(): void
    {
        $path = ['endpoint', 'segment'];
        $type = 'unknown_type';
        $unknown = $this->builder->unknown($path, $type, static::CONTENT);

        $this->assertObjectResolvedWithExpectedMetaAndContent($unknown, UnknownObject::class, $path, $type);
    }
}
