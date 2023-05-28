<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\AutocompleteHelpers;

use Evgeek\Moysklad\Api\Record\Objects\UnknownObject;
use stdClass;

/**
 * Упаковки Товара
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar-towary-atributy-wlozhennyh-suschnostej-upakowki-towara
 *
 * @property ?Barcode[]    $barcodes
 * @property string        $id
 * @property float         $quantity
 * @property UnknownObject $uom
 */
class Pack extends stdClass
{
}
