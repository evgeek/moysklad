<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Formatters;

use stdClass;
use Throwable;

/**
 * @template T
 *
 * @implements JsonFormatterInterface<stdClass>
 */
class StdClassFormat extends AbstractMultiDecoder
{
    /**
     * @return array<stdClass>|stdClass
     */
    public function encode(string $content): stdClass|array
    {
        if ($content === '') {
            return new stdClass();
        }

        try {
            $encodedContent = json_decode($content, false, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable) {
            $this->throwContentIsNotValidJsonObject($content);
        }

        if (!is_a($encodedContent, stdClass::class) && !is_array($encodedContent)) {
            $this->throwContentIsNotValidJsonObject($content);
        }

        return $encodedContent;
    }
}
