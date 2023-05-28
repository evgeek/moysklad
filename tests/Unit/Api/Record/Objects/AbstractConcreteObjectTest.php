<?php

declare(strict_types=1);

namespace Evgeek\Tests\Unit\Api\Record\Objects;

use Evgeek\Moysklad\Api\Record\Collections\Entities\EmployeeCollection;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ProductCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Employee;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Product;
use Evgeek\Moysklad\MoySklad;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject
 */
class AbstractConcreteObjectTest extends TestCase
{
    /**
     * @param class-string<AbstractConcreteObject> $class
     *
     * @dataProvider classAndCollection
     */
    public function testMakeReturnsSameClassWithExpectedContent(string $class): void
    {
        $content = [
            'name' => 'test_name',
            'archived' => true,
        ];

        $object = $class::make(new MoySklad(['token']), $content);

        $this->assertInstanceOf($class, $object);

        foreach ($content as $key => $value) {
            $this->assertSame($value, $object->{$key});
        }
    }

    /**
     * @param class-string<AbstractConcreteObject> $class
     *
     * @dataProvider classAndCollection
     */
    public function testCollectionReturnsExpectedDefaultCollection(string $class, string $collection): void
    {
        $result = $class::collection(new MoySklad(['token']));

        $this->assertInstanceOf($collection, $result);
    }

    public static function classAndCollection(): array
    {
        return [
            [Product::class, ProductCollection::class],
            [Employee::class, EmployeeCollection::class],
        ];
    }
}
