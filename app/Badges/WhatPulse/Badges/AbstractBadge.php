<?php

declare(strict_types=1);

namespace App\Badges\WhatPulse\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\WhatPulse\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'WhatPulse';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
