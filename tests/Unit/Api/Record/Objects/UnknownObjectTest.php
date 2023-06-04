<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Objects;

use Evgeek\Moysklad\Api\Record\Collections\UnknownCollection;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\MoySklad;
use Evgeek\Moysklad\Services\Url;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Objects\UnknownObject
 */
class UnknownObjectTest extends TestCase
{
    private const PATH = ['endpoint', 'segment'];
    private const TYPE = 'unknown-type';

    public function testMakeMethodReturnsSameClassWithExpectedContentAndMeta(): void
    {
        $content = [
            'name' => 'test_name',
            'archived' => true,
        ];

        $object = UnknownObject::make(new MoySklad(['token']), self::PATH, self::TYPE, $content);

        $this->assertInstanceOf(UnknownObject::class, $object);

        foreach ($content as $key => $value) {
            $this->assertSame($value, $object->{$key});
        }

        $this->assertSame(Url::makeFromPathAndParams(self::PATH), $object->meta->href);
        $this->assertSame(self::TYPE, $object->meta->type);
    }

    public function testCollectionMethodReturnsExpectedCollectionAndMeta(): void
    {
        $result = UnknownObject::collection(new MoySklad(['token']), self::PATH, self::TYPE);

        $this->assertInstanceOf(UnknownCollection::class, $result);
    }
}
