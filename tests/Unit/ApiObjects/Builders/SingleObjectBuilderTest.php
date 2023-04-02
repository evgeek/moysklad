<?php

namespace Evgeek\Tests\Unit\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Builders\SingleObjectBuilder;
use Evgeek\Moysklad\ApiObjects\Objects\Employee;
use Evgeek\Moysklad\ApiObjects\Objects\Product;
use Evgeek\Moysklad\Formatters\ApiObjectFormatter;
use Evgeek\Moysklad\Formatters\ApiObjectMapping;
use Evgeek\Moysklad\MoySklad;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\ApiObjects\Builders\AbstractObjectBuilder
 * @covers \Evgeek\Moysklad\ApiObjects\Builders\SingleObjectBuilder
 */
class SingleObjectBuilderTest extends ObjectResolversTestCase
{
    private SingleObjectBuilder $builder;

    protected function setUp(): void
    {
        $this->builder = new SingleObjectBuilder(new MoySklad(['token']));
    }

    public function testResolvingUnregisteredObjectThrowsException(): void
    {
        $mapping = new ApiObjectMapping([], []);
        $ms = new MoySklad(['token'], new ApiObjectFormatter($mapping));
        $builder = new SingleObjectBuilder($ms);

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
}