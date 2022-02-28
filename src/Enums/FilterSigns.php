<?php

declare(strict_types=1);

namespace Evgeek\Moysklad\Enums;

enum FilterSigns: string
{
    case EQ         = '=';
    case NEQ        = '!=';
    case GT         = '>';
    case LT         = '<';
    case GTE        = '>=';
    case LTE        = '<=';
    case LIKE       = '~';
    case PREFIX     = '~=';
    case POSTFIX    = '=~';
}