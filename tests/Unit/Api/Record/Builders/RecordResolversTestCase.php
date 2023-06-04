<?php

namespace Evgeek\Tests\Unit\Api\Record\Builders;

use Evgeek\Moysklad\Api\Record\AbstractRecord;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use PHPUnit\Framework\TestCase;

abstract class RecordResolversTestCase extends TestCase
{
    protected const CONTENT = [
        'test_key' => 'test_value',
        'second_key' => false,
    ];

    /** @param class-string<AbstractRecord> $expectedObjectClass */
    protected function assertObjectResolvedWithExpectedMetaAndContent(
        AbstractRecord $object,
        string $expectedObjectClass,
        array $path = null,
        string $type = null,
    ): void {
        $this->assertInstanceOf($expectedObjectClass, $object);

        $type = $type ?? $expectedObjectClass::TYPE;
        $this->assertSame($type, $object->meta->type);

        $path = $path ?? $expectedObjectClass::PATH;
        $this->assertStringEndsWith(implode('/', $path), $object->meta->href);

        if (is_subclass_of($expectedObjectClass, AbstractConcreteObject::class)) {
            foreach (static::CONTENT as $key => $value) {
                $this->assertSame($value, $object->{$key});
            }
        }
    }
}
