<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\WebhookCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Вебхук
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuki
 *
 * @implements AbstractConcreteObject<WebhookCollection>
 */
class Webhook extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::WEBHOOK,
    ];
    public const TYPE = Type::WEBHOOK;
}
