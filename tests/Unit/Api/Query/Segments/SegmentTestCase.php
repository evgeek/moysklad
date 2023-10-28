<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments;

use Evgeek\Moysklad\Api\Query\AbstractBuilder;
use Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment;
use Evgeek\Moysklad\Api\Query\Segments\Methods\AbstractMethodNamedSegment;
use Evgeek\Moysklad\Tools\Guid;
use Evgeek\Tests\Unit\Api\Query\ApiTestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Query\AbstractBuilder
 * @covers \Evgeek\Moysklad\Api\Query\Segments\AbstractNamedSegment
 */
abstract class SegmentTestCase extends ApiTestCase
{
    protected const GUID1 = '25cf41f2-b068-11ed-0a80-0e9700500d7e';
    protected const GUID2 = '161d25a8-1477-11ec-ac18-000b00000002';

    /** @var class-string<AbstractNamedSegment> */
    protected string $builderClass = '';

    protected AbstractNamedSegment $builder;

    protected function setUp(): void
    {
        parent::setUp();

        $this->builder = new $this->builderClass($this->api, [], []);
    }

    abstract public static function methodsWithCorrespondingSegmentClass(): array;

    /**
     * @param class-string<AbstractMethodNamedSegment> $expectedSegmentClass
     *
     * @dataProvider methodsWithCorrespondingSegmentClass
     */
    public function testMethodReturnsCorrectClass(string $method, string $expectedSegment, string $expectedSegmentClass, array $parent = []): void
    {
        $builder = $this->builder;
        foreach ($parent as $segment) {
            $builder = Guid::check($segment) ?
                $builder->byId($segment) :
                $builder->{$segment}();
        }
        $builder = $builder->{$method}();

        $this->assertSame($expectedSegment, $builder::SEGMENT);
        $this->assertInstanceOf($expectedSegmentClass, $builder);
        $this->assertInstanceOf(AbstractMethodNamedSegment::class, $builder);
        $this->assertInstanceOf(AbstractBuilder::class, $builder);
    }
}
