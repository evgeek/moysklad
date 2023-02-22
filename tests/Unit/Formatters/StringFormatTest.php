<?php

namespace Evgeek\Tests\Unit\Formatters;

use Evgeek\Moysklad\Formatters\StringFormat;

/** @covers \Evgeek\Moysklad\Formatters\StringFormat<extended> */
class StringFormatTest extends MultiDecoderTestCase
{
    protected const FORMATTER = StringFormat::class;

    protected function getEncodedObject(): string
    {
        return static::OBJECT_JSON_STRING;
    }

    protected function getEncodedArray(): string
    {
        return static::ARRAYS_JSON_STRING;
    }

    protected function getEncodedEmpty(): string
    {
        return '';
    }
}
