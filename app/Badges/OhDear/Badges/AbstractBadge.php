<?php

declare(strict_types=1);

namespace App\Badges\OhDear\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\OhDear\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Oh Dear';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
