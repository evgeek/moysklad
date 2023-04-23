<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\AutocompleteHelpers;

use stdClass;

/**
 * Поля алкогольной продукции
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-towar-towary-atributy-wlozhennyh-suschnostej-ob-ekt-soderzhaschij-polq-alkogol-noj-produkcii
 *
 * @property bool  $excise
 * @property int   $type
 * @property float $strength
 * @property float $volume
 */
class Alcoholic extends stdClass
{
}
