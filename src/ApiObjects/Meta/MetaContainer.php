<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\ApiObjects\Meta;

use Evgeek\Moysklad\ApiObjects\Containers\AbstractContainer;

/**
 * @property string $href
 * @property string $type
 * @property string $mediaType
 * @property int    $size
 * @property int    $limit
 * @property int    $offset
 * @property string $nextHref
 * @property string $previousHref
 */
class MetaContainer extends AbstractContainer
{
}
