<?php

namespace Evgeek\Tests\Unit\ApiObjects\Builders;

use Evgeek\Moysklad\ApiObjects\AbstractApiObject;
use PHPUnit\Framework\TestCase;

abstract class ObjectResolversTestCase extends TestCase
{
    protected const CONTENT = [
        'test_key' => 'test_value',
        'second_key' => false,
    ];

    /** @param class-string<AbstractApiObject> $expectedObjectClass */
    protected function assertObjectResolvedWithExpectedMetaAndContent(
        AbstractApiObject $object,
        string $expectedObjectClass,
        array $path = null,
        string $type = null,
    ): void {
        $this->assertInstanceOf($expectedObjectClass, $object);

        $type = $type ?? $expectedObjectClass::TYPE;
        $this->assertSame($type, $object->meta->type);

        $path = $path ?? $expectedObjectClass::PATH;
        $this->assertStringEndsWith(implode('/', $path), $object->meta->href);

        foreach (static::CONTENT as $key => $value) {
            $this->assertSame($value, $object->{$key});
        }
    }
}
