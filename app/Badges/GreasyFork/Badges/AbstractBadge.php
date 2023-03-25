<?php

declare(strict_types=1);

namespace App\Badges\GreasyFork\Badges;

use App\Badges\AbstractBadge as Badge;
use App\Badges\GreasyFork\Client;

abstract class AbstractBadge extends Badge
{
    protected string $service = 'Greasy Fork';

    public function __construct(protected readonly Client $client)
    {
        //
    }
}
