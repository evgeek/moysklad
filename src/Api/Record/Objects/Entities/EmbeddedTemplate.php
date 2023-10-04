<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\EmbeddedTemplateCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Стандартный шаблон печатной формы
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy
 *
 * @implements AbstractConcreteObject<EmbeddedTemplateCollection>
 */
class EmbeddedTemplate extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::EMBEDDEDTEMPLATE,
    ];
    public const TYPE = Type::EMBEDDEDTEMPLATE;
}
