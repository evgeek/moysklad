<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\AutocompleteHelpers;

use stdClass;

/**
 * Код маркировки
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-kody-markirowki
 *
 * @property string $id
 * @property string $cis
 * @property string $type
 * @property null|list<TrackingcodeObject> trackingCodes
 */
class TrackingcodeObject extends stdClass
{
}
