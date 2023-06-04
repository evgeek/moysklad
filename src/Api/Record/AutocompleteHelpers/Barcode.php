<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\AutocompleteHelpers;

use stdClass;

/**
 * Штрихкоды
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar-towary-atributy-wlozhennyh-suschnostej-shtrihkody
 *
 * @property ?string $ean13
 * @property ?string $ean8
 * @property ?string $code128
 * @property ?string $gtin
 */
class Barcode extends stdClass
{
}
