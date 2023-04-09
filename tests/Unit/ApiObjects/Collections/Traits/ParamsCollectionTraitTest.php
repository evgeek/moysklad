<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\ApiObjects\Collections\Traits;

use Evgeek\Moysklad\Enums\FilterSign;
use Evgeek\Moysklad\Enums\OrderDirection;
use Evgeek\Moysklad\Services\Url;

/**
 * @covers \Evgeek\Moysklad\ApiObjects\Collections\Traits\ParamsCollectionTrait
 */
class ParamsCollectionTraitTest extends CollectionTraitCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->expectedUrl = Url::API . '/' . implode('/', static::PATH);
    }

    public function testSingleExpandMethod(): void
    {
        $collection = $this->getTestCollection()
            ->expand('field1');
        $this->expectedUrl .= '?expand=field1';

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testMultipleExpandMethods(): void
    {
        $collection = $this->getTestCollection()
            ->expand('field1')
            ->expand('field2');
        $this->expectedUrl .= '?expand=' . urlencode('field1,field2');

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testExpandMethodWithMultipleExpands(): void
    {
        $collection = $this->getTestCollection()
            ->expand(['field1', 'field2'])
            ->expand('field3');
        $this->expectedUrl .= '?expand=' . urlencode('field1,field2,field3');

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testSingleFilterMethod(): void
    {
        $collection = $this->getTestCollection()
            ->filter('field1', true);
        $this->expectedUrl .= '?filter=' . urlencode('field1=true');

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testMultipleFilterMethods(): void
    {
        $collection = $this->getTestCollection()
            ->filter('field1', '!=', 123)
            ->filter('field2', FilterSign::GTE, 'text');
        $this->expectedUrl .= '?filter=' . urlencode('field1!=123;field2>=text');

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testFilterMethodWithMultipleFilters(): void
    {
        $collection = $this->getTestCollection()
            ->filter([
                ['field2', true],
                ['field3', '!!!', 123.45],
            ])
            ->filter('field1', FilterSign::LT, 'value');
        $this->expectedUrl .= '?filter=' . urlencode('field2=true;field3!!!123.45;field1<value');

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testSingleLimitMethod(): void
    {
        $collection = $this->getTestCollection()
            ->limit(111);
        $this->expectedUrl .= '?limit=111';

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testSecondLimitMethodReplacePrevious(): void
    {
        $collection = $this->getTestCollection()
            ->limit(100)
            ->limit(200);
        $this->expectedUrl .= '?limit=200';

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testSingleOffsetMethod(): void
    {
        $collection = $this->getTestCollection()
            ->offset(111);
        $this->expectedUrl .= '?offset=111';

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testSecondOffsetMethodReplacePrevious(): void
    {
        $collection = $this->getTestCollection()
            ->offset(100)
            ->offset(200);
        $this->expectedUrl .= '?offset=200';

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }
    public function testSingleOrderMethod(): void
    {
        $collection = $this->getTestCollection()
            ->order('field');
        $this->expectedUrl .= '?order=' . urlencode('field,asc');

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testMultipleOrderMethods(): void
    {
        $collection = $this->getTestCollection()
            ->order('field1', 'desc')
            ->order('field2', OrderDirection::ASC);
        $this->expectedUrl .= '?order=' . urlencode('field1,desc;field2,asc');

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testOrderMethodWithMultipleOrders(): void
    {
        $collection = $this->getTestCollection()
            ->order([
                ['field2'],
                ['field3', 'asc'],
            ])
            ->order('field1', OrderDirection::DESC);
        $this->expectedUrl .= '?order=' . urlencode('field2,asc;field3,asc;field1,desc');

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testSingleSearchMethod(): void
    {
        $collection = $this->getTestCollection()
            ->search('value');
        $this->expectedUrl .= '?search=value';

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testSecondSearchMethodReplacePrevious(): void
    {
        $collection = $this->getTestCollection()
            ->search('value1')
            ->search('value2');
        $this->expectedUrl .= '?search=value2';

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testSingleParamMethod(): void
    {
        $collection = $this->getTestCollection()
            ->param('field', 'value');
        $this->expectedUrl .= '?field=value';

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testMultipleParamMethodsWithReplacedParam(): void
    {
        $collection = $this->getTestCollection()
            ->param('field', 'value1')
            ->param('field', 'value2');
        $this->expectedUrl .= '?field=value2';

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testMultipleParamMethodsWithAddedParam(): void
    {
        $collection = $this->getTestCollection()
            ->param('filter', 'key1=value1')
            ->param('filter', 'key2=value2');
        $this->expectedUrl .= '?filter=' . urlencode('key1=value1;key2=value2');

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }

    public function testParamMethodsWithMultipleDifferentParams(): void
    {
        $collection = $this->getTestCollection()
            ->param([
                ['filter', 'key1=value1'],
                ['expand', 'field1'],
                ['expand', 'field2'],
                ['param', 'value1'],
                ['param', 'value2'],
            ])
            ->param('filter', 'key2=value2');
        $this->expectedUrl .= '?filter=' . urlencode('key1=value1;key2=value2') .
            '&expand=' . urlencode('field1,field2') .
            '&param=value2';

        $this->assertSame($this->expectedUrl, $collection->meta->href);
    }
}
