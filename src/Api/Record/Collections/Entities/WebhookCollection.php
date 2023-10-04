<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\Webhook;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Вебхуков
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuki
 *
 * @implements AbstractConcreteCollection<Webhook>
 */
class WebhookCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::WEBHOOK,
    ];
    public const TYPE = Type::WEBHOOK;
}
