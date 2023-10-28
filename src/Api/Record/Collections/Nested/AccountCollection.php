<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Api\Record\Collections\Nested;

use Evgeek\Moysklad\Api\Record\Collections\AbstractNestedCollection;
use Evgeek\Moysklad\Api\Record\Objects\Nested\Account;
use Evgeek\Moysklad\Dictionaries\Segment;
use Evgeek\Moysklad\Dictionaries\Type;

/**
 * Коллекция Счетов юрлица
 *
 * @see https://dev.moysklad.ru/doc/api/remap/1.2/dictionaries/#suschnosti-jurlico-scheta-urlica
 *
 * @implements AbstractNestedCollection<Account>
 */
class AccountCollection extends AbstractNestedCollection
{
    public const PATH = [
        Segment::ACCOUNTS,
    ];
    public const TYPE = Type::ACCOUNT;
}
