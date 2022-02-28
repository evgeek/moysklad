<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Enums;

enum OrderDirection: string
{
    case ASC = 'asc';
    case DESC = 'desc';
}