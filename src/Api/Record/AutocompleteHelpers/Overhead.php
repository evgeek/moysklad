<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\AutocompleteHelpers;

use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use stdClass;

/**
 * Дополнительные расходы
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-komplekt-komplekty-atributy-wlozhennyh-suschnostej-dopolnitel-nye-rashody
 *
 * @property int           $value
 * @property UnknownObject $currency
 */
class Overhead extends stdClass
{
}
