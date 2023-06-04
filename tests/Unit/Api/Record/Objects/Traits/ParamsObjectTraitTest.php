<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Objects\Traits;

use Evgeek\Moysklad\Services\Url;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Objects\Traits\ParamsObjectTrait
 */
class ParamsObjectTraitTest extends ObjectTraitCase
{
    private string $expectedUrl = '';

    protected function setUp(): void
    {
        parent::setUp();

        $this->expectedUrl = Url::API . '/' . implode('/', [...static::PATH, static::GUID]);
    }

    public function testSingleExpandMethod(): void
    {
        $object = $this->getTestObject(['id' => static::GUID])
            ->expand('field1');
        $this->expectedUrl .= '?expand=field1';

        $this->assertSame($this->expectedUrl, $object->meta->href);
    }

    public function testMultipleExpandMethods(): void
    {
        $object = $this->getTestObject(['id' => static::GUID])
            ->expand('field1')
            ->expand('field2');
        $this->expectedUrl .= '?expand=' . urlencode('field1,field2');

        $this->assertSame($this->expectedUrl, $object->meta->href);
    }

    public function testExpandMethodWithMultipleExpands(): void
    {
        $object = $this->getTestObject(['id' => static::GUID])
            ->expand(['field1', 'field2'])
            ->expand('field3');
        $this->expectedUrl .= '?expand=' . urlencode('field1,field2,field3');

        $this->assertSame($this->expectedUrl, $object->meta->href);
    }

    public function testSingleParamMethod(): void
    {
        $object = $this->getTestObject(['id' => static::GUID])
            ->param('field', 'value');
        $this->expectedUrl .= '?field=value';

        $this->assertSame($this->expectedUrl, $object->meta->href);
    }

    public function testMultipleParamMethodsWithReplacedParam(): void
    {
        $object = $this->getTestObject(['id' => static::GUID])
            ->param('field', 'value1')
            ->param('field', 'value2');
        $this->expectedUrl .= '?field=value2';

        $this->assertSame($this->expectedUrl, $object->meta->href);
    }

    public function testMultipleParamMethodsWithAddedParam(): void
    {
        $object = $this->getTestObject(['id' => static::GUID])
            ->param('filter', 'key1=value1')
            ->param('filter', 'key2=value2');
        $this->expectedUrl .= '?filter=' . urlencode('key1=value1;key2=value2');

        $this->assertSame($this->expectedUrl, $object->meta->href);
    }

    public function testParamMethodsWithMultipleDifferentParams(): void
    {
        $object = $this->getTestObject(['id' => static::GUID])
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

        $this->assertSame($this->expectedUrl, $object->meta->href);
    }
}
