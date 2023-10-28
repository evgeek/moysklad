<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\WebhookStock;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Вебхуков на изменение остатков
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-vebhuk-na-izmenenie-ostatkow
 *
 * @implements AbstractConcreteCollection<WebhookStock>
 */
class WebhookStockCollection extends AbstractEntityCollection
{
    public const PATH = [
        Segment::ENTITY,
        Segment::WEBHOOKSTOCK,
    ];
    public const TYPE = Type::WEBHOOKSTOCK;
}
