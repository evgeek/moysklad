<?php

namespace Evgeek\Tests\Unit\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use Evgeek\Moysklad\ApiObjects\AbstractConcreteApiObject;
use Evgeek\Moysklad\ApiObjects\Collections\AbstractConcreteCollection;
use PHPUnit\Framework\TestCase;

abstract class ObjectResolversTestCase extends TestCase
{
    protected const CONTENT = [
        'test_key' => 'test_value',
        'second_key' => false,
    ];

    /** @param class-string<AbstractConcreteApiObject>|class-string<AbstractConcreteCollection> $expectedObjectClass */
    protected function assertObjectResolvedWithExpectedMetaAndContent(AbstractApiObject $object, string $expectedObjectClass): void
    {
        $this->assertInstanceOf($expectedObjectClass, $object);
        $this->assertSame($expectedObjectClass::TYPE, $object->meta->type);
        $this->assertStringEndsWith(implode('/', $expectedObjectClass::PATH), $object->meta->href);

        foreach (static::CONTENT as $key => $value) {
            $this->assertSame($value, $object->{$key});
        }
    }
}
