<?php

namespace Evgeek\Tests\Unit\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\Builders\AbstractObjectBuilder;
use Evgeek\Moysklad\ApiObjects\Builders\ApiObjectBuilder;
use Evgeek\Moysklad\ApiObjects\Builders\CollectionObjectBuilder;
use Evgeek\Moysklad\ApiObjects\Builders\SingleObjectBuilder;
use Evgeek\Moysklad\MoySklad;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\ApiObjects\Builders\ApiObjectBuilder */
class ApiObjectBuilderTest extends TestCase
{
    private ApiObjectBuilder $builder;

    protected function setUp(): void
    {
        $this->builder = new ApiObjectBuilder(new MoySklad(['token']));
    }

    public function testSingleMethodReturnsSingleBuilder(): void
    {
        $single = $this->builder->single();

        $this->assertInstanceOf(SingleObjectBuilder::class, $single);
        $this->assertInstanceOf(AbstractObjectBuilder::class, $single);
    }

    public function testCollectionMethodReturnsSingleBuilder(): void
    {
        $single = $this->builder->collection();

        $this->assertInstanceOf(CollectionObjectBuilder::class, $single);
        $this->assertInstanceOf(AbstractObjectBuilder::class, $single);
    }
}
