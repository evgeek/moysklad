<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\EmbeddedTemplate;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Стандартных шаблонов печатной формы
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy
 *
 * @implements AbstractConcreteCollection<EmbeddedTemplate>
 */
class EmbeddedTemplateCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::EMBEDDEDTEMPLATE,
    ];
    public const TYPE = Type::EMBEDDEDTEMPLATE;
}
