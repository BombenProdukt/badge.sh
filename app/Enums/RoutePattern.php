<?php

declare(strict_types=1);

namespace App\Enums;

enum RoutePattern: string
{
    case CATCH_ALL                = '.+';
    case PACKAGE_WITH_SCOPE       = '([a-z]+)|(@[a-z]+\/[a-z]+)';
    case PACKAGE_WITH_SCOPE_ONLY  = '(@[a-z]+\/[a-z]+)';
    case PACKAGE_WITH_VENDOR      = '([a-z]+)|([a-z]+\/[a-z]+)';
    case PACKAGE_WITH_VENDOR_ONLY = '([a-z]+\/[a-z]+)';
}
