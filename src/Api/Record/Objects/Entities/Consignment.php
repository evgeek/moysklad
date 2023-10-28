<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Entities;

use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\Barcode;
use Evgeek\Moysklad\Api\Record\AutocompleteHelpers\MetaObject;
use Evgeek\Moysklad\Api\Record\Collections\Entities\ConsignmentCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractConcreteObject;
use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Серия
 *
 * @property string           $accountId    ID учетной записи
 * @property ?UnknownObject[] $attributes   Метаданные ссылки или модификации
 * @property ?Barcode[]       $barcodes     Штрихкоды серии
 * @property ?string          $code         Код Серии
 * @property ?string          $description  Описание Серии
 * @property string           $externalCode Внешний код Серии
 * @property string           $id           ID Серии
 * @property ?UnknownObject   $image        Изображение товара, к которому относится данная серия
 * @property string           $label        Метка Серии
 * @property ?MetaObject      $meta         Метаданные Серии
 * @property string           $name         Наименование Серии. "Собирается" и отображается как "Наименование товара / Метка Серии"
 * @property string           $updated      Момент последнего обновления сущности
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-seriq
 *
 * @implements AbstractConcreteObject<ConsignmentCollection>
 */
class Consignment extends AbstractEntity
{
    public const PATH = [
        Segment::ENTITY,
        Segment::CONSIGNMENT,
    ];
    public const TYPE = Type::CONSIGNMENT;
}
