<?php

namespace Evgeek\Tests\Unit\Api\Record\Builders;

use Evgeek\Moysklad\Api\Record\Builders\AbstractBuilder;
use Evgeek\Moysklad\Api\Record\Builders\CollectionBuilder;
use Evgeek\Moysklad\Api\Record\Builders\ObjectBuilder;
use Evgeek\Moysklad\Api\Record\Builders\RecordBuilder;
use Evgeek\Moysklad\MoySklad;
use PHPUnit\Framework\TestCase;

/** @covers \Evgeek\Moysklad\Api\Record\Builders\RecordBuilder */
class RecordBuilderTest extends TestCase
{
    private RecordBuilder $builder;

    protected function setUp(): void
    {
        $this->builder = new RecordBuilder(new MoySklad(['token']));
    }

    public function testSingleMethodReturnsSingleBuilder(): void
    {
        $single = $this->builder->object();

        $this->assertInstanceOf(ObjectBuilder::class, $single);
        $this->assertInstanceOf(AbstractBuilder::class, $single);
    }

    public function testCollectionMethodReturnsSingleBuilder(): void
    {
        $single = $this->builder->collection();

        $this->assertInstanceOf(CollectionBuilder::class, $single);
        $this->assertInstanceOf(AbstractBuilder::class, $single);
    }
}
