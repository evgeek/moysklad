<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Collections\Traits;

use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Enums\HttpMethod;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use InvalidArgumentException;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Collections\Traits\CrudCollectionTrait
 */
class CrudCollectionTraitTest extends CollectionTraitCase
{
    public function testGetMethodCallsSendWithExpectedParams(): void
    {
        $collection = $this->getTestCollection();
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, ['limit' => '100'], [], ['rows' => '']);

        $collection->limit(100)->get();
    }

    public function testMassCreateUpdateMethodCallsSendWithExpectedParams(): void
    {
        $context = [
            'employee' => [
                'meta' => $this->ms->meta()->employee(static::GUID1),
            ],
        ];
        $content = [
            [
                'meta' => $this->ms->meta()->create(static::PATH, static::TYPE),
                'name' => 'create entity',
            ],
            [
                'meta' => $this->ms->meta()->create([...static::PATH, static::GUID1], static::TYPE),
                'id' => static::GUID1,
                'name' => 'update entity',
            ],
        ];
        $collection = $this->getTestCollection(['context' => $context]);
        $this->expectsSendCalledWith(HttpMethod::POST, static::PATH, [], $content);

        $collection->massCreateUpdate($content);

        $this->assertSame($context, $collection->toArray()['context']);
    }

    public function testMassCreateUpdateMethodCallsSendWithExpectedParamsFromCollection(): void
    {
        $content = [
            [
                'meta' => $this->ms->meta()->create(static::PATH, static::TYPE),
                'name' => 'create entity',
            ],
            [
                'meta' => $this->ms->meta()->create([...static::PATH, static::GUID1], static::TYPE),
                'id' => static::GUID1,
                'name' => 'update entity',
            ],
        ];
        $ms = new MoySklad(['token']);
        $updatableCollection = new UnknownCollection($ms, static::PATH, static::TYPE, ['rows' => $content]);
        $collection = $this->getTestCollection();
        $this->expectsSendCalledWith(HttpMethod::POST, static::PATH, [], $updatableCollection->rows);

        $collection->massCreateUpdate($updatableCollection);
    }

    public function testMassDeleteMethodCallsSendWithExpectedParams(): void
    {
        $content = [
            [
                'meta' => $this->ms->meta()->create([...static::PATH, static::GUID1], static::TYPE),
                'id' => static::GUID1,
                'name' => 'update entity',
            ],
        ];
        $collection = $this->getTestCollection();
        $this->expectsSendCalledWith(HttpMethod::POST, [...static::PATH, 'delete'], [], $content);

        $collection->massDelete($content);
    }

    public function testMassDeleteMethodCallsSendWithExpectedParamsFromCollection(): void
    {
        $content = [
            [
                'meta' => $this->ms->meta()->create([...static::PATH, static::GUID1], static::TYPE),
                'id' => static::GUID1,
                'name' => 'update entity',
            ],
        ];
        $ms = new MoySklad(['token']);
        $deletableCollection = new UnknownCollection($ms, static::PATH, static::TYPE, ['rows' => $content]);
        $collection = $this->getTestCollection();
        $this->expectsSendCalledWith(HttpMethod::POST, [...static::PATH, 'delete'], [], $deletableCollection->rows);

        $collection->massDelete($deletableCollection);
    }

    public function testGetNextMethodWithNext(): void
    {
        $params = ['limit' => '100', 'offset' => '100'];
        $meta = $this->ms->meta()->create(static::PATH, static::TYPE);
        $meta['nextHref'] = Url::makeFromPathAndParams(static::PATH, $params);
        $collection = $this->getTestCollection(['meta' => $meta]);

        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, $params, [], ['rows' => '']);
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
        [$path] = Url::parsePathAndParams($meta['href']);
        $meta['href'] = Url::makeFromPathAndParams($path, $newParams);
        $meta['previousHref'] = Url::makeFromPathAndParams(static::PATH, []);
        $collection = $this->getTestCollection(['meta' => $meta]);

        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, [], [], ['rows' => '']);

        $collection->getPrevious();
    }

    public function testGetPrevMethodWithoutPrev(): void
    {
        $collection = $this->getTestCollection();

        $this->assertNull($collection->getPrevious());
    }

    public function testReceivedNotCollectionThrows(): void
    {
        $collection = $this->getTestCollection();
        $this->expectsSendCalledWith(HttpMethod::GET, static::PATH, [], []);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Response must be a collection, object received');
        $collection->get();
    }
}
