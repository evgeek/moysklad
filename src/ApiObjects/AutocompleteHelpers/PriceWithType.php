<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\AutocompleteHelpers;

use Evgeek\Moysklad\ApiObjects\Objects\UnknownObject;
use stdClass;

/**
 * Цена
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar-towary-atributy-wlozhennyh-suschnostej-ceny-prodazhi
 *
 * @property int           $value
 * @property UnknownObject $currency
 * @property UnknownObject $priceType
 */
class PriceWithType extends stdClass
{
}
