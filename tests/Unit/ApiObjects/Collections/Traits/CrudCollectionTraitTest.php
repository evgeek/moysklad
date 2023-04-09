<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\ApiObjects\Collections\Traits;

use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\Services\Url;

/**
 * @covers \Evgeek\Moysklad\ApiObjects\Collections\Traits\CrudCollectionTrait
 */
class CrudCollectionTraitTest extends CollectionTraitCase
{
    public function testGetMethodCallsSendWithExpectedParams(): void
    {
        $collection = $this->getTestCollection();
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, ['limit' => '100'], []);

        $collection->limit(100)->get();
    }

    public function testMassCreateUpdateMethodCallsSendWithExpectedParams(): void
    {
        $context = [
            'employee' => [
                'meta' => $this->ms->meta()->employee(static::GUID),
            ],
        ];
        $content = [
            [
                'meta' => $this->ms->meta()->create(static::PATH, static::TYPE),
                'name' => 'create entity',
            ],
            [
                'meta' => $this->ms->meta()->create([...static::PATH, static::GUID], static::TYPE),
                'id' => static::GUID,
                'name' => 'update entity',
            ],
        ];
        $collection = $this->getTestCollection(['context' => $context]);
        $this->expectsSendCalledWith(HttpMethod::POST, static::PATH, [], $content);

        $collection->massCreateUpdate($content);

        $this->assertSame($context, $collection->toArray()['context']);
    }

    public function testMassDeleteMethodCallsSendWithExpectedParams(): void
    {
        $content = [
            [
                'meta' => $this->ms->meta()->create([...static::PATH, static::GUID], static::TYPE),
                'id' => static::GUID,
                'name' => 'update entity',
            ],
        ];
        $collection = $this->getTestCollection();
        $this->expectsSendCalledWith(HttpMethod::POST, [...static::PATH, 'delete'], [], $content);

        $collection->massDelete($content);
    }

    public function testGetNextMethodWithNext(): void
    {
        $params = ['limit' => '100', 'offset' => '100'];
        $meta = $this->ms->meta()->create(static::PATH, static::TYPE);
        $meta['nextHref'] = Url::makeFromPathAndParams(static::PATH, $params);
        $collection = $this->getTestCollection(['meta' => $meta]);

        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params, []);
        $collection->getNext();
    }

    public function testGetNextMethodWithoutNext(): void
    {
        $collection = $this->getTestCollection();

        $this->assertNull($collection->getNext());
    }

    public function testGetPrevMethodWithPrev(): void
    {
        $newParams = ['limit' => '100', 'offset' => '100'];
        $meta = $this->ms->meta()->create(static::PATH, static::TYPE);
        [$path, $params] = Url::parsePathAndParams($meta['href']);
        $meta['href'] = Url::makeFromPathAndParams($path, $newParams);
        $meta['previousHref'] = Url::makeFromPathAndParams(static::PATH, []);
        $collection = $this->getTestCollection(['meta' => $meta]);

        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, [], []);

        $collection->getPrevious();
    }

    public function testGetPrevMethodWithoutPrev(): void
    {
        $collection = $this->getTestCollection();

        $this->assertNull($collection->getPrevious());
    }
}
