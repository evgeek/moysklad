<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\Nested\EmbeddedTemplate;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Стандартных шаблонов печатной формы
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy
 *
 * @implements AbstractNestedCollection<EmbeddedTemplate>
 */
class EmbeddedTemplateCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::METADATA,
        Segment::EMBEDDEDTEMPLATE,
    ];
    public const TYPE = Type::EMBEDDEDTEMPLATE;
}
