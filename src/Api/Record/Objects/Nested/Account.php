<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Objects\Nested;

use Evgeek\Moysklad\Api\Record\Collections\Nested\AccountCollection;
use Evgeek\Moysklad\Api\Record\Collections\Nested\FilesCollection;
use Evgeek\Moysklad\Api\Record\Objects\AbstractNestedObject;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Счёт юрлица
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jurlico-scheta-urlica
 *
 * @implements AbstractNestedObject<AccountCollection>
 */
class Account extends AbstractNestedObject
{
    public const PATH = [
        Segment::ACCOUNTS,
    ];
    public const TYPE = Type::ACCOUNT;
}
