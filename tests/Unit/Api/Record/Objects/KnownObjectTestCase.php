<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Objects;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Api\Record\Objects\ObjectInterface;
use Evgeek\Moysklad\MoySklad;
use PHPUnit\Framework\TestCase;

abstract class KnownObjectTestCase extends TestCase
{
    /**
     * @param class-string<AbstractConcreteObject|AbstractNestedObject>              $objectClass
     * @param null|class-string<AbstractConcreteCollection|AbstractNestedCollection> $collectionClass
     *
     * @dataProvider classAndCollection
     */
    public function testMakeReturnsSameClassWithExpectedContent(
        string $objectClass,
        ?string $collectionClass,
        ObjectInterface|array|string|null $parent = null
    ): void {
        $content = [
            'name' => 'test_name',
            'archived' => true,
        ];

        $ms = new MoySklad(['']);
        $object = $parent ?
            $objectClass::make($ms, $parent, $content) :
            $objectClass::make($ms, $content);

        $this->assertInstanceOf($objectClass, $object);

        foreach ($content as $key => $value) {
            $this->assertSame($value, $object->{$key});
        }
    }

    /**
     * @param class-string<AbstractConcreteObject|AbstractNestedObject>              $objectClass
     * @param null|class-string<AbstractConcreteCollection|AbstractNestedCollection> $collectionClass
     *
     * @dataProvider classAndCollection
     */
    public function testCollectionReturnsExpectedDefaultCollection(
        string $objectClass,
        ?string $collectionClass,
        ObjectInterface|array|string|null $parent = null
    ): void {
        if (!$collectionClass) {
            $this->assertNull($collectionClass);

            return;
        }

        $ms = new MoySklad(['']);
        $result = $parent ?
            $objectClass::collection($ms, $parent) :
            $objectClass::collection($ms);

        $this->assertInstanceOf($collectionClass, $result);
    }

    abstract public static function classAndCollection(): array;
}
