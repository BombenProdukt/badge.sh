<?php

declare(strict_types=1);

namespace App\Badges\Maintenance;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Maintenance';
}
