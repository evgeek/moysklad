<?php

namespace Evgeek\Tests\Unit\Api\Query\Segments\ById;

use Evgeek\Moysklad\Api\Query\Segments\ById\AbstractByIdSegment;
use Evgeek\Moysklad\Api\Query\Segments\ById\ByIdEmployeeSegment;
use Evgeek\Moysklad\Api\Query\Segments\Special\MassSegmentDelete;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\ApiTestCase;

/** @covers \Evgeek\Moysklad\Api\Query\Segments\ById\ByIdEmployeeSegment */
abstract class ByIdSegmentTestCase extends ApiTestCase
{
    private AbstractByIdSegment $builder;

    /** @var class-string<AbstractByIdSegment> */
    protected const SEGMENT_CLASS = null;

    protected function setUp(): void
    {
        parent::setUp();

        $segmentClass = static::SEGMENT_CLASS;
        $this->builder = new $segmentClass($this->api, static::PREV_PATH, static::PARAMS, static::GUID);
    }

    /** @dataProvider methodsWithSegment */
    public function testSegmentMethodCalledAsExpected(string $method, string $expectedClass, string $expectedSegment): void
    {
        $nestedSegment = $this->builder->{$method}();
        $this->assertInstanceOf($expectedClass, $nestedSegment);

        $this->expectsSendCalledWith(
            HttpMethod::GET,
            [...static::PREV_PATH, static::GUID, $expectedSegment],
            static::PARAMS,
        );

        $nestedSegment->get();
    }

    abstract public static function methodsWithSegment(): array;
}
