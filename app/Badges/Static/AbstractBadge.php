<?php

declare(strict_types=1);

namespace App\Badges\Static;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Static Badge';
}
