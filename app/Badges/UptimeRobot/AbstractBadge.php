<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot;

use App\Badges\AbstractBadge as Badge;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'UptimeRobot';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
