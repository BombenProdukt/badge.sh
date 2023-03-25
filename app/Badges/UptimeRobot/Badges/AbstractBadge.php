<?php

declare(strict_types=1);

namespace App\Badges\UptimeRobot\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\UptimeRobot\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'UptimeRobot';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
