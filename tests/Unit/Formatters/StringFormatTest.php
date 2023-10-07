<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\Formatters\StringFormat;

/**
 * @covers \Evgeek\Moysklad\Formatters\AbstractMultiDecoder
 * @covers \Evgeek\Moysklad\Formatters\StringFormat
 */
class StringFormatTest extends MultiDecoderTestCase
{
    protected const FORMATTER = StringFormat::class;

    protected static function getEncodedObject(): string
    {
        return static::OBJECT_JSON_STRING;
    }

    protected static function getEncodedArray(): string
    {
        return static::ARRAYS_JSON_STRING;
    }

    protected static function getEncodedEmpty(): string
    {
        return '';
    }

    public static function invalidJsonTypesDataProvider(): array
    {
        return [];
    }
}
