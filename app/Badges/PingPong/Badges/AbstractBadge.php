<?php

declare(strict_types=1);

namespace App\Badges\PingPong\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\PingPong\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'PingPong';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
