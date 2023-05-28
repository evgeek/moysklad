<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\AutocompleteHelpers;

use stdClass;

/**
 * Фотография сотрудника
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-sotrudnik-sotrudniki-atributy-wlozhennyh-suschnostej-fotografiq-sotrudnika-struktura-i-zagruzka
 *
 * @property string     $filename
 * @property MetaObject $meta
 * @property MetaObject $miniature
 * @property MetaObject $tiny
 * @property int        $size
 * @property string     $title
 * @property string     $updated
 */
class Image extends stdClass
{
}
