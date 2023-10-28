<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\Collections\Entities\WebhookStockCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Вебхук на изменение остатков
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuk-na-izmenenie-ostatkow
 *
 * @implements AbstractConcreteObject<WebhookStockCollection>
 */
class WebhookStock extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::WEBHOOKSTOCK,
    ];
    public const TYPE = Type::WEBHOOKSTOCK;
}
