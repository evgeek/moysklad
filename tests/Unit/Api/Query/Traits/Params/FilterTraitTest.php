<?php

namespace Evgeek\Tests\Unit\Api\Query\Traits\Params;

use Evgeek\Moysklad\Api\Query\Segments\AbstractCommonSegment;
use Evgeek\Moysklad\Enums\FilterSign;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Tests\Unit\Api\Query\Traits\TraitTestCase;
use InvalidArgumentException;

/** @covers \Evgeek\Moysklad\Api\Query\Traits\Params\FilterTrait */
class FilterTraitTest extends TraitTestCase
{
    public function testSingleStringFilter(): void
    {
        $params = static::PARAMS + ['filter' => 'filter1=value1'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeFilterBuilder()
            ->filter('filter1', '=', 'value1')
            ->get();
    }

    public function testSingleStringFilterWithDefaultSign(): void
    {
        $params = static::PARAMS + ['filter' => 'filter1=value1'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeFilterBuilder()
            ->filter('filter1', 'value1')
            ->get();
    }

    public function testSingleStringFilterWithEnumSign(): void
    {
        $params = static::PARAMS + ['filter' => 'filter1=value1'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeFilterBuilder()
            ->filter('filter1', FilterSign::EQ, 'value1')
            ->get();
    }

    public function testSingleStringFilterSemicolonInValueEscaped(): void
    {
        $params = static::PARAMS + ['filter' => 'filter1=va\;lue1'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeFilterBuilder()
            ->filter('filter1', '=', 'va;lue1')
            ->get();
    }

    public function testMultipleStringFilters(): void
    {
        $params = static::PARAMS + ['filter' => 'filter1~=value1;filter2>value2'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeFilterBuilder()
            ->filter('filter1', '~=', 'value1')
            ->filter('filter2', '>', 'value2')
            ->get();
    }

    public function testSingleArrayFilter(): void
    {
        $params = static::PARAMS + ['filter' => 'filter1=value1;filter2>value2'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeFilterBuilder()
            ->filter([
                ['filter1', 'value1'],
                ['filter2', FilterSign::GT, 'value2'],
            ])
            ->get();
    }

    public function testArrayAndNotArrayFiltersTogether(): void
    {
        $params = static::PARAMS + ['filter' => 'filter1=value1;filter2>value2;filter3~=value3'];
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params);

        $this->makeFilterBuilder()
            ->filter([
                ['filter1', 'value1'],
                ['filter2', FilterSign::GT, 'value2'],
            ])
            ->filter('filter3', '~=', 'value3')
            ->get();
    }

    public function testArrayFilterMustContainsArrays(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Each filter must be an array');

        $this->makeFilterBuilder()
            ->filter(['filter1', 'value1'])
            ->get();
    }

    public function testFilterPassedThroughSegments(): void
    {
        $path = [...static::PATH, 'additional_segment'];
        $params = static::PARAMS + ['filter' => 'filter1=value1;filter2>value2;filter3~=value3'];
        $this->expectsSendCalledWith(HttpMethod::GET, $path, $params);

        $this->makeFilterBuilder()
            ->filter('filter1', 'value1')
            ->method('additional_segment')
            ->filter([
                ['filter2', FilterSign::GT, 'value2'],
                ['filter3', '~=', 'value3'],
            ])
            ->get();
    }

    public function testFilterPassedWithoutSignCauseException(): void
    {
        $message = "For filter key 'filter1': sign missed";
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($message);

        $this->makeFilterBuilder()
            ->filter('filter1')
            ->get();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($message);

        $this->makeFilterBuilder()
            ->filter([['filter1']])
            ->get();
    }

    public function testFilterPassedWithoutProperlyValueCauseException(): void
    {
        $message = "For filter key 'filter1': with a sign, you must pass the value as the third parameter";
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($message);

        $this->makeFilterBuilder()
            ->filter('filter1', FilterSign::EQ)
            ->get();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($message);

        $this->makeFilterBuilder()
            ->filter([['filter1', FilterSign::NEQ]])
            ->get();
    }

    /** @dataProvider incorrectSignsByTypeDataProvider */
    public function testFilterPassedWithNotProperlySignTypeCauseException(mixed $incorrectSign): void
    {
        $message = "For filter key 'filter1': with a value, sign must be a string or " . FilterSign::class;
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($message);

        $this->makeFilterBuilder()
            ->filter('filter1', $incorrectSign, 'value1')
            ->get();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage($message);

        $this->makeFilterBuilder()
            ->filter([['filter1', $incorrectSign, 'value1']])
            ->get();
    }

    public static function incorrectSignsByTypeDataProvider(): array
    {
        return [
            [1],
            [1.23],
            [false],
            [true],
            [-88],
        ];
    }

    private function makeFilterBuilder(): AbstractCommonSegment
    {
        return new class($this->api, static::PREV_PATH, static::PARAMS, 'test_segment') extends AbstractCommonSegment {
        };
    }
}
