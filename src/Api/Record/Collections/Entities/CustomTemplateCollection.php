<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Entities;

use Evgeek\Moysklad\Api\Record\Collections\AbstractConcreteCollection;
use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\Entities\CustomTemplate;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Пользовательских шаблонов печатной формы
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-shablon-pechatnoj-formy
 *
 * @implements AbstractNestedCollection<CustomTemplate>
 */
class CustomTemplateCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::METADATA,
        Segment::CUSTOMTEMPLATE,
    ];
    public const TYPE = Type::CUSTOMTEMPLATE;
}
