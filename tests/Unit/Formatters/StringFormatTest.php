<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\Formatters\StringFormat;

/** @covers \Evgeek\Moysklad\Formatters\StringFormat<extended> */
class StringFormatTest extends MultiDecoderTestCase
{
    protected string $formatter = StringFormat::class;

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
}
